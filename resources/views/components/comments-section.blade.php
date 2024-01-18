<div>
    <h4 class="mb-0">
        <span id="totalCommentsValue">{{ $recipe->comments_count }}</span>
        <span id="totalCommentsLabel">{{ trans_choice('modules.comment.choice', $recipe->comments_count) }}</span>
    </h4>

    <hr>

    @auth
        <x-comment-create-form :$recipe />
    @else
        <div class="my-4">
            <p class="text-center">
                {!! __('modules.comment.create.login', [
                    'login' => "<a class='text-success' href=' " . route('login') . "'>" . __('Login') . "</a>",
                    'register' => "<a class='text-success' href=' " . route('register') . "'>" . __('register') . "</a>",
                ]) !!}
            </p>
        </div>
    @endauth

    <div id="commentsContainer"></div>

    <div class="d-none justify-content-center align-items-center" id="commentLoader">
        <a class="text-success mt-3" role="button">Cargar más...</a>
    </div>

    <div class="d-none justify-content-center align-items-center" id="commentSpinner">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showElement(commentSpinner)

            getComments(currentPage)
        })

        const commentsContainer = document.querySelector('#commentsContainer');
        const totalCommentsValue = document.querySelector('#totalCommentsValue');
        const totalCommentsLabel = document.querySelector('#totalCommentsLabel');
        const commentSpinner = document.querySelector('#commentSpinner');
        const commentLoader = document.querySelector('#commentLoader');

        let currentPage = 1

        const getComments = async function (page) {
            try {
                const _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let response = await axios.get(`/recipes/${@json($recipe->slug)}/comments?page=${page}`, { headers: { 'X-CSRF-TOKEN': _token } })

                response.data.data.forEach(comment => {
                    commentsContainer.append(createCommentElement(comment))

                    if (@json(auth()->id()) == comment.user_id) {
                        initComment(comment)
                    }
                })

                currentPage++

                if (response.data.meta.next_page_url) {
                    showElement(commentLoader)
                } else {
                    hideElement(commentLoader)
                }

                hideElement(commentSpinner)
            } catch(error) {
                console.log(error)

                hideElement(commentSpinner)
            }
        }

        const hideElement = function (element) {
            element.classList.remove('d-flex');
            element.classList.add('d-none');
        };

        const showElement = function (element) {
            element.classList.remove('d-none');
            element.classList.add('d-flex');
        };

        commentLoader.addEventListener('click', function () {
            getComments(currentPage)
        })

        function createCommentElement (comment) {
            const commentCard = document.createElement('div')
            const classAttr = document.createAttribute('class')
            const idAttr = document.createAttribute('id')

            classAttr.value = 'card px-4 py-3 mb-3 border-0'
            idAttr.value = `comment${comment.id}`

            commentCard.setAttributeNode(classAttr)
            commentCard.setAttributeNode(idAttr)

            commentCard.innerHTML = `
                <p class="mb-0">${comment.body}</p>
                <p class="mb-0 text-end">
                    <small class="fw-semibold">${comment.user_name}</small>
                    &middot;
                    <small>${comment.created_at}</small>
                </p>
            `
            
            if (@json(auth()->id()) == comment.user_id) {
                commentCard.innerHTML += `
                    <div class="btn-group position-absolute" style="top: 2px; right: 2px;">
                        <button class="btn btn-light bg-white border-0 text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis"></i>
                        </button>
                        <ul class="dropdown-menu" style="z-index: 1021;">
                            <li>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editComment${comment.id}">
                                    ${@json(__('Edit'))}
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteComment${comment.id}">
                                    ${@json(__('Delete'))}
                                </button>
                            </li>
                        </ul>
                    </div>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editComment${comment.id}" tabindex="-1" aria-labelledby="editComment${comment.id}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editComment${comment.id}Label">${@json(__('modules.comment.edit.title'))}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger alert-dismissible fade show d-none" role="alert" id="errorEditContainer"></div>
                                    <form id="editComment${comment.id}Form" method="post" class="p-6">
                                        @method('PUT')

                                        <textarea
                                            class="form-control"
                                            id="body"
                                            name="body"
                                            rows="3"
                                            x-data
                                            x-autosize
                                        >${@json(old('body'))}</textarea>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        ${@json(__('Cancel'))}
                                    </button>
                                    <button type="submit" class="btn btn-success" form="editComment${comment.id}Form">
                                        ${@json(__('Save'))}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteComment${comment.id}" tabindex="-1" aria-labelledby="deleteComment${comment.id}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        ${@json(__('modules.comment.delete.description'))}
                                    </div>
                                    <form id="deleteComment${comment.id}Form" method="post" class="p-6"></form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        ${@json(__('Cancel'))}
                                    </button>
                                    <button type="submit" class="btn btn-danger" form="deleteComment${comment.id}Form">
                                        ${@json(__('modules.comment.delete.action'))}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal -->
                `
            }

            return commentCard
        }

        function initComment (comment) {
            const _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const commentEditForm = document.querySelector(`#editComment${comment.id}Form`);
            const commentDeleteForm = document.querySelector(`#deleteComment${comment.id}Form`);
            const errorEditContainer = document.querySelector('#errorEditContainer');
            const commentItem = document.querySelector(`#comment${comment.id}`);

            const editModal = new bootstrap.Modal(document.querySelector(`#editComment${comment.id}`), {
                keyboard: false
            });

            const deleteModal = new bootstrap.Modal(document.querySelector(`#deleteComment${comment.id}`), {
                keyboard: false
            });

            commentEditForm.addEventListener('submit', function (event) {
                event.preventDefault()

                editComment()
            })

            commentDeleteForm.addEventListener('submit', function (event) {
                event.preventDefault()

                deleteComment()
            })

            const editComment = async function () {
                await axios.post(`/recipes/${@json($recipe->slug)}/comments/${comment.id}`, commentEditForm, { headers: { 'X-CSRF-TOKEN': _token } })
                    .then(response => {
                        commentItem.querySelector('p').textContent = response.data.body

                        editModal.hide()
                    }).catch(error => {
                        addError(error?.response?.data?.errors?.body[0])
                    })
            }

            const deleteComment = async function () {
                await axios.delete(`/recipes/${@json($recipe->slug)}/comments/${comment.id}`, { headers: { 'X-CSRF-TOKEN': _token } })
                    .then(response => {
                        removeCommentCard()
                    }).catch(error => {
                        console.log(error)
                    })
            }

            const addError = function (message = 'There was an error, try later...') {
                errorEditContainer.classList.remove('d-none')
                errorEditContainer.classList.add('d-block')
                commentEditForm.querySelector('#body').classList.add('is-invalid')

                errorEditContainer.innerHTML = `
                    <span>${message}</span>
                    <button type="button" class="btn-close"></button>
                `
                editModal.show()

                errorEditContainer.querySelector('button').addEventListener('click', clearError)
            }

            const clearError = function () {
                commentEditForm.querySelector('#body').classList.remove('is-invalid')
                errorEditContainer.classList.add('d-none')
                errorEditContainer.classList.remove('d-block')
            }

            const removeCommentCard = function () {
                deleteModal.hide()

                commentItem.remove()

                var count = parseInt(totalCommentsValue.textContent) - 1

                totalCommentsValue.textContent = count

                totalCommentsLabel.textContent = numerous.pluralize(@json(App::getLocale()), count, {
                    one: @json(__('modules.comment.singular')),
                    other: @json(__('modules.comment.plural')),
                })

                if (count == 0) {
                    const emptyCommentsMessage = document.createElement('div')
                    const classAttr = document.createAttribute('class')
                    const idAttr = document.createAttribute('id')

                    classAttr.value = 'fst-italic text-center'
                    idAttr.value = 'commentsEmptyMessage'

                    emptyCommentsMessage.setAttributeNode(classAttr)
                    emptyCommentsMessage.setAttributeNode(idAttr)

                    emptyCommentsMessage.textContent = @json(__('modules.comment.index.empty'))

                    commentsContainer.appendChild(emptyCommentsMessage)
                }
            }

            document.querySelector(`#editComment${comment.id}`).addEventListener('show.bs.modal', function (event) {
                commentEditForm.querySelector('#body').value = commentItem.querySelector('p').textContent
            })

            document.querySelector(`#editComment${comment.id}`).addEventListener('shown.bs.modal', function (event) {
                commentEditForm.querySelector('#body').focus()
            })

            document.querySelector(`#editComment${comment.id}`).addEventListener('hidden.bs.modal', function (event) {
                clearError()
            })
        }
    </script>
@endpush
