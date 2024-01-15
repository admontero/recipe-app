<div class="bg-white p-4 rounded-3 shadow-sm mb-4">
    <form action="{{ route('recipes.search') }}">
        <h4 class="text-success">{{ __('front.components.recipe-search-card.title') }}</h4>

        <hr>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-search"></i>
                </span>
                <x-input
                    class="{{ $errors->get('title') ? 'is-invalid' : '' }}"
                    type="search"
                    name="title"
                    id="title"
                    placeholder="{{ __('front.components.recipe-search-card.input') }}"
                />
            </div>

            <x-input-error for="title"></x-input-error>
        </div>

        <div>
            <div class="d-grid gap-2">
                <button class="btn btn-success" type="submit">{{ __('front.components.recipe-search-card.button') }}</button>
            </div>
        </div>
    </form>
</div>
