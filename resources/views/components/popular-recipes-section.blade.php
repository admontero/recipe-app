<div>
    @if ($recipes->count())
        <div>
            <h3 class="py-2">{{ __('front.components.popular-recipes-section.title') }}</h3>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                @foreach ($recipes as $recipe)
                    <div class="col mb-4">
                        <x-recipe-card :$recipe />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
