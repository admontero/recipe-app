<x-app-front-layout>
    <div class="row py-3">
        <div class="col-lg-8 m-auto">
            <div class="card p-3 shadow-sm">
                <h1 class="m-0">{{ $recipe->title }}</h1>

                <hr>

                <div>
                    <span>
                        <span class="fw-bold">{{ __('Published at') }}:</span>
                        {{ $recipe->publish_date }}
                    </span>

                    <span class="mx-2 fs-4 fw-bold text-success">&middot</span>

                    <span>
                        <span class="fw-bold">{{ __('Author') }}:</span>
                        <a class="text-success" href="{{ route('recipes.user.show', $recipe->user) }}">
                            {{ $recipe->user->name }}
                        </a>
                    </span>

                    <span class="mx-2 fs-4 fw-bold text-success">&middot</span>

                    <span>
                        <span class="fw-bold">{{ __('Category') }}:</span>
                        <a class="text-success" href="{{ route('recipes.user.show', $recipe->user) }}">
                            {{ $recipe->category->name }}
                        </a>
                    </span>
                </div>

                <hr>

                <div class="clearfix">
                    <div class="float-md-start me-4 mb-3 mb-md-0">
                        <img
                            class="img-fluid rounded-3 d-block mx-auto"
                            src="{{ $recipe->image_url }}"
                            alt="{{ $recipe->title }}'s image"
                        />
                    </div>
                    <p class="lead text-muted">
                        {{ $recipe->excerpt }}
                    </p>
                </div>

                <hr>

                <div style="font-size: 1.125rem;">
                    {!! $recipe->description !!}
                </div>

                <div class="mx-md-n3 bg-success py-2 mb-3">
                    <h5 class="px-2 px-md-3 mb-0 text-white">{{ __('front.recipes.show.ingredients.title') }}</h5>
                </div>

                <div style="font-size: 1.125rem;">
                    {!! $recipe->ingredients !!}
                </div>

                <div class="mx-md-n3 bg-success py-2 mb-3">
                    <h5 class="px-2 px-md-3 mb-0 text-white">{{ __('front.recipes.show.preparation.title') }}</h5>
                </div>

                <div style="font-size: 1.125rem;">
                    {!! $recipe->preparation !!}
                </div>
            </div>

            @auth
                <div class="text-center">
                    <form class="position-relative" action="{{ route('recipes.favorites', $recipe) }}" id="favoriteForm">
                        <button
                            class="favorite-btn {{ $recipe->isFavorite(auth()->id()) ? 'favorite-active' : '' }}"
                            id="favoriteBtn"
                        ></button>
                        <div class="position-absolute w-100" style="bottom: -.75rem;">
                            <p class="small">
                                <span id="favoriteCount" class="fw-semibold">{{ $recipe->favorites_count }}</span>
                                <span id="favoriteLabel">{{ trans_choice('modules.favorite.choice', $recipe->favorites_count) }}</span>
                            </p>
                        </div>
                    </form>
                </div>
            @else
                <div class="text-center mt-3">
                    <p class="small">
                        <span class="fw-semibold">{{ $recipe->favorites_count }}</span>
                        <span id="favoriteLabel">{{ trans_choice('modules.favorite.choice', $recipe->favorites_count) }}</span>
                    </p>
                </div>
            @endauth

            <hr>

            <x-comments-section :$recipe />

        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 2rem;">
                <hr class="d-block d-lg-none">

                <x-tags-card :tags="$recipe->tags" />

                <x-recipe-search-card />

                <x-categories-card :categories="$categoriesWithRecipesCount" />
            </div>
        </div>
    </div>

    @auth
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const favoriteForm = document.querySelector('#favoriteForm');
                    const favoriteBtn = document.querySelector('#favoriteBtn');
                    const favoriteCount = document.querySelector('#favoriteCount');
                    const favoriteLabel = document.querySelector('#favoriteLabel');

                    favoriteForm.addEventListener('submit', function (event) {
                        event.preventDefault()

                        toggleFavorite()
                    })

                    const toggleFavorite = async function () {
                        await axios.post(`/recipes/${@json($recipe->slug)}/favorites`, favoriteForm, { headers: { 'X-CSRF-TOKEN': _token } })
                            .then(response => {
                                if (response.data.isFavorite) {
                                    favoriteBtn.classList.add('favorite-active')
                                } else {
                                    favoriteBtn.classList.remove('favorite-active')
                                }

                                favoriteCount.textContent = response.data.count
                                favoriteLabel.textContent = numerous.pluralize(@json(App::getLocale()), response.data.count, {
                                    one: @json(__('modules.favorite.singular')),
                                    other: @json(__('modules.favorite.plural')),
                                })
                            }).catch(error => {
                                console.log(error)
                            })
                    }
                })
            </script>
        @endpush
    @endauth
</x-app-front-layout>
