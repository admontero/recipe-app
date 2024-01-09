<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input
                        class="{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email', $request->email)"
                        autofocus
                        autocomplete="username"
                        {{-- required --}}
                    />

                    <x-input-error for="email" />
                </div>

                <!-- Password -->
                <div class="mt-2">
                    <x-label for="password" :value="__('Password')" />

                    <x-input
                        class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        {{-- required --}}
                    />

                    <x-input-error for="password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-2">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input
                        class="{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        {{-- required --}}
                    />

                    <x-input-error for="password_confirmation" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
