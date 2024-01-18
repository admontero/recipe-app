<div>
    <form method="POST" class="my-4" id="commentForm">
        <div class="alert alert-danger alert-dismissible fade show d-none" role="alert" id="errorContainer"></div>

        <div class="mb-2">
            <textarea
                class="form-control"
                id="body"
                name="body"
                rows="3"
                placeholder="{{ __('modules.comment.create.placeholder') }}"
                x-data
                x-autosize
            >{{ old('body') }}</textarea>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-success">
                {{ __('modules.comment.create.button') }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            commentForm.addEventListener('submit', function (event) {
                event.preventDefault()

                createComment()
            })
        })

        const commentForm = document.querySelector('#commentForm');
        const commentBody = commentForm.querySelector('#body');
        const errorContainer = document.querySelector('#errorContainer');

        const createComment = async function () {
            const _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            await axios.post(`/recipes/${@json($recipe->slug)}/comments`, commentForm, { headers: { 'X-CSRF-TOKEN': _token } })
                .then(response => {
                    commentBody.value = ''
                    addComment(response.data)
                }).catch(error => {
                    addError(error?.response?.data?.errors?.body[0])
                })
        }

        const addComment = function (comment) {
            commentsContainer.prepend(createCommentElement(comment))

            initComment(comment)

            var count = parseInt(totalCommentsValue.textContent) + 1

            totalCommentsValue.textContent = count

            totalCommentsLabel.textContent = numerous.pluralize(@json(App::getLocale()), count, {
                one: @json(__('modules.comment.singular')),
                other: @json(__('modules.comment.plural')),
            })

            clearError()

            if (count) {
                document.querySelector('#commentsEmptyMessage')?.remove()
            }
        }

        const addError = function (message = 'There was an error, try later...') {
            errorContainer.classList.remove('d-none')
            errorContainer.classList.add('d-block')

            errorContainer.innerHTML = `
                <span>${message}</span>
                <button type="button" class="btn-close"></button>
            `
            
            errorContainer.querySelector('button').addEventListener('click', clearError)
        }

        const clearError = function () {
            commentBody.classList.remove('is-invalid')
            errorContainer.classList.add('d-none')
            errorContainer.classList.remove('d-block')
        }
    </script>
@endpush
