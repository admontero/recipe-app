<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('user.create.header') }}
        </h2>
    </x-slot>

    <x-breadcrumbs>
        <li class="breadcrumb-item">
            <a href="{{ route('users.index') }}">{{ __('user.index.header') }}</a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">{{ __('user.create.header') }}</li>
    </x-breadcrumbs>

    <x-form-section method="post" action="{{ route('users.store') }}">
        <x-slot name="title">
            {{ __('user.create.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('user.create.description') }}
        </x-slot>

        <x-slot name="form">
            @csrf

            <div class="col-md-6 mb-2">
                <x-label value="{{ __('Name') }}" />

                <x-input
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    autofocus
                    {{-- required --}}
                />

                <x-input-error for="name" />
            </div>

            <div class="col-md-6 mb-2">
                <x-label value="{{ __('Email') }}" />

                <x-input
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    type="text"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    autofocus
                    {{-- required --}}
                />

                <x-input-error for="email" />
            </div>

            <div class="col-md-6 mb-2">
                <x-label value="{{ __('Password') }}" />

                <x-input
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    type="password"
                    name="password"
                    autocomplete="new-password"
                    {{-- required --}}
                />

                <x-input-error for="password"></x-input-error>
            </div>

            <div class="col-md-6 mb-2">
                <x-label value="{{ __('Confirm Password') }}" />

                <x-input
                    class="form-control"
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    {{-- required --}}
                />
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="is_admin" id="exampleCheck1" value="1">
                    <label class="form-check-label" for="exampleCheck1">{{ __('Is Admin?') }}</label>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <x-button>{{ __('Save') }}</x-button>
            </div>
        </x-slot>
    </x-form-section>
</x-app-layout>
