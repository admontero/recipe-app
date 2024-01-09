<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="card-body">
            <x-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-2">
                    <x-label value="{{ __('Email') }}" />

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

                <div class="mb-2">
                    <x-label value="{{ __('Password') }}" />

                    <x-input
                        class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="current-password"
                        {{-- required --}}
                    />

                    <x-input-error for="password"></x-input-error>
                </div>

                <div class="mb-2">
                    <div class="custom-control custom-checkbox">
                        <x-checkbox id="remember_me" name="remember" />

                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted me-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button>
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>

