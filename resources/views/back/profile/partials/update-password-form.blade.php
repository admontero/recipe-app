<x-form-section method="POST" action="{{ route('password.update') }}">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="alert">
        @if (session('status') === 'password-updated')
            <x-alert type="success" message="{{ __('modules.profile.password.alert') }}" />
        @endif
    </x-slot>

    <x-slot name="form">
        @csrf
        @method('put')

        <div class="mt-2">
            <x-label for="update_password_current_password" :value="__('Current Password')" />
            <x-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}" autocomplete="current-password" />
            <x-input-error class="mt-2" for="current_password" keyForm="updatePassword" />
        </div>

        <div class="mt-2">
            <x-label for="update_password_password" :value="__('New Password')" />
            <x-input id="update_password_password" name="password" type="password" class="mt-1 block w-full {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}" autocomplete="new-password" />
            <x-input-error class="mt-2" for="password" keyForm="updatePassword" />
        </div>

        <div class="mt-2">
            <x-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="new-password" />
            <x-input-error class="mt-2" for="password_confirmation" keyForm="updatePassword" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>{{ __('Save') }}</x-button>

        {{-- @if (session('status') === 'password-updated')
            <span class="m-1 fade-out">{{ __('Saved.') }}</span>
        @endif --}}
    </x-slot>
</x-form-section>
