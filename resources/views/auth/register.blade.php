<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <x-validation-errors class="mb-3" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-2">
                    <x-label value="{{ __('Name') }}" />

                    <x-input
                        class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                        type="text"
                        name="name"
                        :value="old('name')"
                        autofocus
                        autocomplete="name"
                        {{-- required --}}
                    />

                    <x-input-error for="name"></x-input-error>
                </div>

                <div class="mb-2">
                    <x-label value="{{ __('Email') }}" />

                    <x-input
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        type="email"
                        name="email"
                        :value="old('email')"
                        {{-- required  --}}
                    />

                    <x-input-error for="email"></x-input-error>
                </div>

                <div class="mb-2">
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

                <div class="mb-2">
                    <x-label value="{{ __('Confirm Password') }}" />

                    <x-input
                        class="form-control"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        {{-- required --}}
                    />
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button>
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
