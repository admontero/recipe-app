<x-app-front-layout>
    <div class="album">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">
                    {{ __('front.recipes.favorite-show.title') }}
                </h3>

                <hr>

                @if ($recipes->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        @foreach ($recipes as $recipe)
                            <div class="col mb-4">
                                <x-recipe-card :$recipe />
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="fst-italic text-muted text-center">
                        <p>{{ __('front.recipes.favorite-show.empty') }}</p>
                    </div>
                @endif

                <div class="d-flex justify-content-center">
                    {{ $recipes->links() }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 2rem;">
                    <hr class="d-block d-lg-none">

                    <x-recipe-search-card />

                    <x-categories-card :categories="$categoriesWithRecipesCount" />
                </div>
            </div>
        </div>
    </div>
</x-app-front-layout>
