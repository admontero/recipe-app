<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('recipe.edit.header') }}
        </h2>
    </x-slot>

    <x-breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('recipes.index') }}">{{ __('recipe.index.header') }}</a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">{{ __('recipe.edit.header') }}</li>
    </x-breadcrumbs>

    <x-form-section method="post" action="{{ route('recipes.update', $recipe) }}" id="recipeForm" enctype="multipart/form-data">
        <x-slot name="title">
            {{ __('recipe.edit.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('recipe.edit.description') }}
        </x-slot>

        <x-slot name="form">
            @method('PUT')
            @csrf

            <div class="mb-2">
                <x-label value="{{ __('Publication Date') }}" />

                <input
                    class="form-control"
                    type="text"
                    id="published_at"
                    name="published_at"
                    value="{{ old('published_at', $recipe->published_at) }}"
                    placeholder="{{ __('Select a date...') }}"
                    data-input
                />

                <x-input-error for="published_at" />
            </div>

            <div class="mb-2">
                <x-label value="{{ __('Title') }}" />

                <x-input
                    class="{{ $errors->has('title') ? 'is-invalid' : '' }}"
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $recipe->title) }}"
                    autofocus
                    {{-- required --}}
                />

                <x-input-error for="title" />
            </div>


            <div class="mb-2">
                <x-label value="{{ __('Image') }}" />

                <x-input
                    class="{{ $errors->has('image') ? 'is-invalid' : '' }}"
                    type="file"
                    id="image"
                    name="image"
                    accept="image/png, image/jpeg"
                    {{-- required --}}
                />

                <x-input-error for="image" />
            </div>

            <div class="mb-2">
                <x-label value="{{ __('Category') }}" />

                <select id="selectCategory" autocomplete="off" name="category_id">
                    <option value="">{{ __('Select a category...') }}</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id', $recipe->category_id) == $category->id)
                        >{{ $category->name }}</option>
                    @endforeach
                </select>

                <x-input-error for="category_id" />
            </div>

            <div class="mb-2">
                <x-label value="{{ __('Tags') }}" />

                <select id="selectTags" multiple autocomplete="off" name="tags[]">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>

                <x-input-error for="tags" />
                <x-input-error for="tags.*" />
            </div>

            <div class="mb-2">
                <x-label value="{{ __('Excerpt') }}" />

                <textarea
                    class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}"
                    id="excerpt"
                    name="excerpt"
                    rows="3"
                >{{ old('excerpt', $recipe->excerpt) }}</textarea>

                <x-input-error for="excerpt" />
            </div>

            <div class="mb-2">
                <x-label value="{{ __('Description') }}" />

                <div id="containerDescription">
                    <div class="quill-editor" id="description"></div>
                </div>

                <input type="hidden" id="quillDescription" name="description" value="{{ old('description', $recipe->description) }}"></input>

                <x-input-error for="description" />
            </div>

            <div class="mb-2">
                <x-label value="{{ __('Ingredients') }}" />

                <div id="containerIngredients">
                    <div class="quill-editor" id="ingredients"></div>
                </div>

                <input type="hidden" id="quillIngredients" name="ingredients" value="{{ old('ingredients', $recipe->ingredients) }}"></input>

                <x-input-error for="ingredients" />
            </div>

            <div class="mb-2">
                <x-label value="{{ __('Preparation') }}" />

                <div id="containerPreparation">
                    <div class="quill-editor" id="preparation"></div>
                </div>

                <input type="hidden" id="quillPreparation" name="preparation" value="{{ old('preparation', $recipe->preparation) }}"></input>

                <x-input-error for="preparation" />
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <x-button>{{ __('Save') }}</x-button>
            </div>
        </x-slot>
    </x-form-section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/quill-image-resize@3.0.9/image-resize.min.js"></script>

        <script>
            window.addEventListener('load', function () {
                Quill.register('modules/imageResize', ImageResize.default);

                var flatpickrPublishedAt = flatpickr('#published_at', {
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i',
                });

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

                var tomSelectTags = new TomSelect('#selectTags', {
                    plugins: {
                        remove_button: {
                            title:'Remove this item',
                        },
                        clear_button: {
                            title:'Remove all selected options',
                        }
                    },
	                labelField: 'title',
                    persist: false,
                    create: true,
                    maxItems: 5,
                });

                if (@json($errors->has('tags'))) {
                    tomSelectTags.control.classList.add('has-error')
                } else {
                    tomSelectTags.control.classList.remove('has-error')
                }

                tomSelectTags.addOptions(@json(old('tags', $recipe->tags->pluck('id')) ?? []).map(element => ({ title: element, value: element })))
                tomSelectTags.setValue(@json(old('tags', $recipe->tags->pluck('id')) ?? []))

                var quillDescription = new Quill('#description', {
                    modules: {
                        toolbar: [
                            [{ 'font': [] }],
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'align': [] }],
                            ['link', 'image'],
                            ['clean'],
                        ],
                        imageResize: {
                            modules: [ 'Resize', 'DisplaySize' ]
                        }
                    },
                    scrollingContainer: '#containerDescription',
                    placeholder: 'Compose an epic...',
                    theme: 'snow',
                });

                quillDescription.on('text-change', function(delta, oldDelta, source) {
                    document.getElementById('quillDescription').value = quillDescription.root.innerHTML
                });

                var quillIngredients = new Quill('#ingredients', {
                    modules: {
                        toolbar: [
                            [{ 'font': [] }],
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'align': [] }],
                            ['link'],
                            ['clean'],
                        ]
                    },
                    scrollingContainer: '#containerIngredients',
                    placeholder: 'Compose an epic...',
                    theme: 'snow',
                });

                quillIngredients.on('text-change', function(delta, oldDelta, source) {
                    document.getElementById('quillIngredients').value = quillIngredients.root.innerHTML
                });

                var quillPreparation = new Quill('#preparation', {
                    modules: {
                        toolbar: [
                            [{ 'font': [] }],
                            [{ 'header': [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'align': [] }],
                            ['link', 'image'],
                            ['clean'],
                        ],
                        imageResize: {
                            modules: [ 'Resize', 'DisplaySize' ]
                        }
                    },
                    scrollingContainer: '#containerPreparation',
                    placeholder: 'Compose an epic...',
                    theme: 'snow',
                });

                quillPreparation.on('text-change', function(delta, oldDelta, source) {
                    document.getElementById('quillPreparation').value = quillPreparation.root.innerHTML
                });

                quillDescription.root.innerHTML = document.getElementById('quillDescription').value
                quillIngredients.root.innerHTML = document.getElementById('quillIngredients').value
                quillPreparation.root.innerHTML = document.getElementById('quillPreparation').value
            })
        </script>
    @endpush
</x-app-layout>
