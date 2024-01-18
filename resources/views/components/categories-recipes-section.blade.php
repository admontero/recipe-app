<div>
    @foreach ($categories as $category)
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h3 class="py-2">{{ $category->name }}</h3>
            <a class="text-success" href="{{ route('recipes.category.show', $category) }}">{{ __('front.components.categories-recipes-section.anchor') }}</a>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 {{ ! $loop->last ? 'mb-4' : '' }}">
            @foreach ($category->recipes as $recipe)
                <div class="col">
                    <x-recipe-card :$recipe :showCategoryLabel="false" />
                </div>
            @endforeach
        </div>
    @endforeach
</div>
