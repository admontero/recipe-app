<div>
    @foreach ($categories as $category)
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h3 class="py-2">{{ $category->name }}</h3>
            <a class="text-success" href="{{ route('recipes.category.show', $category) }}">{{ __('front.components.categories-recipes-section.anchor') }}</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
            @foreach ($category->recipes as $recipe)
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
    @endforeach
</div>
