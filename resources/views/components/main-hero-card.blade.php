<div class="container col-xxl-8 px-4 py-2 rounded mt-lg-5 bg-white shadow">
    <form>
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6 mx-auto mb-4 mb-lg-0">
                <img src="{{ asset('./images/hamburger.jpg') }}" class="d-block img-fluid rounded" alt="Bootstrap Themes" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-6 fw-bold lh-1 mb-3 text-center">{{ __('front.components.main-hero-card.title') }}</h1>

                <p class="lead mb-3">
                    {{ __('front.components.main-hero-card.subtitle-1') }}
                    <br>
                    {{ __('front.components.main-hero-card.subtitle-2') }}
                </p>

                <div class="col-md-8 mx-auto mb-2">
                    <select id="selectCategory" autocomplete="off" name="category_id">
                        <option value="">{{ __('front.components.main-hero-card.select') }}</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                @selected(old('category_id') == $category->id)
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-8 mx-auto">
                    <x-input type="search" name="title" id="title" placeholder="{{ __('front.components.main-hero-card.input') }}" />
                    <x-input-error for="title"></x-input-error>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        window.addEventListener('load', function () {
            var tomSelectCategory = new TomSelect('#selectCategory', {
                create: false,
                sortField: {
                    field: 'text',
                    direction: 'asc',
                }
            });

            if (@json($errors->has('category_id'))) {
                tomSelectCategory.control.classList.add('has-error')
            } else {
                tomSelectCategory.control.classList.remove('has-error')
            }
        })
    </script>
@endpush
