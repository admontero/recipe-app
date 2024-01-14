<x-form-section method="POST" action="{{ route('back.profile.update') }}">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <form
        id="send-verification"
        class="d-none"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <x-slot name="alert">
        @if (session('status') === 'profile-updated')
            <x-alert type="success" message="{{ __('modules.profile.edit.alert') }}" />
        @endif
    </x-slot>

    <x-slot name="form">
        @csrf
        @method('patch')

        <div class="mt-2">
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" name="name" type="text" class="mt-1 block w-full {{ $errors->has('name') ? 'is-invalid' : '' }}" :value="old('name', $user->name)" autofocus autocomplete="name" />
            <x-input-error class="mt-2" for="name" />
        </div>

        <div class="mt-2">
            <x-label for="email" :value="__('Email')" />
            <x-input id="email" name="email" type="email" class="mt-1 block w-full {{ $errors->has('email') ? 'is-invalid' : '' }}" :value="old('email', $user->email)" autocomplete="username" />
            <x-input-error class="mt-2" for="email" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>{{ __('Save') }}</x-button>

        {{-- @if (session('status') === 'profile-updated')
            <span class="m-1 fade-out">{{ __('Saved.') }}</span>
        @endif --}}
    </x-slot>
</x-form-section>
