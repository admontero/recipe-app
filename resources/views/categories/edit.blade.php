<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('category.edit.header') }}
        </h2>
    </x-slot>

    <x-breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('categories.index') }}">{{ __('category.index.header') }}</a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">{{ __('category.edit.header') }}</li>
    </x-breadcrumbs>

    <x-form-section method="POST" action="{{ route('categories.update', $category) }}">
        <x-slot name="title">
            {{ __('category.edit.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('category.edit.description') }}
        </x-slot>

        <x-slot name="form">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <x-label value="{{ __('Name') }}" />

                <x-input
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    autofocus
                    {{-- required --}}
                />

                <x-input-error for="name" />
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <x-button>{{ __('Save') }}</x-button>
            </div>
        </x-slot>
    </x-form-section>
</x-app-layout>
