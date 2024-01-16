<x-app-front-layout>
    <div class="row">
        <div class="col-lg-8 m-auto">
            <h1 class="text-success">{{ $recipe->title }}</h1>

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

            <hr>

            <div class="bg-white p-4 rounded-3 shadow-sm">
                <h4 class="text-success">{{ __('front.recipes.show.ingredients.title') }}</h4>

                <hr>

                <div style="font-size: 1.125rem;">
                    {!! $recipe->ingredients !!}
                </div>
            </div>

            <hr>

            <div class="bg-white p-4 rounded-3 shadow-sm">
                <h4 class="text-success">{{ __('front.recipes.show.preparation.title') }}</h4>

                <hr>

                <div style="font-size: 1.125rem;">
                    {!! $recipe->preparation !!}
                </div>
            </div>

            @auth
                <hr>

                <div class="text-center">
                    <form class="position-relative" action="{{ route('recipes.favorite', $recipe) }}" id="favoriteForm">
                        <button
                            class="favorite-btn {{ $recipe->isFavorite(auth()->id()) ? 'favorite-active' : '' }}"
                            id="favoriteBtn"
                        ></button>
                        <div class="position-absolute w-100" style="bottom: -.75rem;">
                            <p>
                                <span id="favoriteCount" class="fw-bold me-1">{{ $recipe->favorites_count }} </span> {{ __('front.recipes.show.favorites') }}
                            </p>
                        </div>
                    </form>
                </div>
            @endauth
        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 2rem;">
                <hr class="d-block d-lg-none">

                <x-tags-card :tags="$recipe->tags" />

                <x-recipe-search-card />

                <x-categories-card />
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

                    favoriteForm.addEventListener('submit', function (event) {
                        event.preventDefault()

                        toggleFavorite()
                    })

                    const toggleFavorite = async function () {
                        await axios.post(`/recipes/${@json($recipe->slug)}/favorite`, favoriteForm, { headers: { 'X-CSRF-TOKEN': _token } })
                            .then(response => {
                                if (response.data.isFavorite) {
                                    favoriteBtn.classList.add('favorite-active')
                                } else {
                                    favoriteBtn.classList.remove('favorite-active')
                                }

                                favoriteCount.textContent = response.data.count
                            }).catch(error => {
                                console.log(error)
                            })
                    }
                })
            </script>
        @endpush
    @endauth
</x-app-front-layout>
