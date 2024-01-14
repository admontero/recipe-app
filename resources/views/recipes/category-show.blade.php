<x-app-front-layout>
    <div class="album">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-4">{{ __('front.recipes.category-show.title') }}: <span class="text-success">{{ $category->name }}</span></h3>
                @if ($recipes->count() > 0)
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        @foreach ($recipes as $recipe)
                            <div class="col mb-4">
                                <div class="card h-100  shadow-sm">
                                    <a href="{{ route('recipes.show', $recipe) }}">
                                        <img class="bd-placeholder-img card-img-top" src="{{ $recipe->image_url }}" />
                                    </a>

                                    <div class="card-body">
                                        <div class="d-flex justify-content-between small mb-1">
                                            <p class="text-black-50">{{ $recipe->published_at->diffForHumans() }}</p>
                                            <p class="fw-bold bg-body-secondary px-2 rounded">{{ $recipe->user->name }}</p>
                                        </div>
                                        <h5 class="card-title">{{ $recipe->title }}</h5>
                                        <p class="card-text line-clamp-3 text-muted">{{ $recipe->excerpt }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <x-recipes-empty-alert />
                @endif

                <div class="d-flex justify-content-center">
                    {{ $recipes->links() }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 2rem;">
                    <hr class="d-block d-lg-none">

                    <x-recipe-search-card />

                    <x-categories-card />
                </div>
            </div>
        </div>
    </div>
</x-app-front-layout>
