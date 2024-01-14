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
                    {{ $recipe->user->name }}
                </span>

                <span class="mx-2 fs-4 fw-bold text-success">&middot</span>

                <span>
                    <span class="fw-bold">{{ __('Category') }}:</span>
                    {{ $recipe->category->name }}
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

            <hr>

            <div class="d-flex justify-content-center text-center">
                Like Me
            </div>
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
</x-app-front-layout>
