<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <div class="mb-4 text-muted">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <x-validation-errors class="mb-3 rounded-0" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        autofocus
                        {{-- required --}}
                    />

                    <x-input-error for="email"></x-input-error>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <x-button>
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
