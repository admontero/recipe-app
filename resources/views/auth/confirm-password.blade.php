<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <div class="mb-3 text-sm text-muted">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <x-validation-errors class="mb-3 rounded-0" />

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div>
                    <x-label for="password" value="{{ __('Password') }}" />

                    <x-input
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="current-password"
                        autofocus
                        {{-- required --}}
                    />

                    <x-input-error for="password"></x-input-error>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <x-button class="ms-4">
                        {{ __('Confirm') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
