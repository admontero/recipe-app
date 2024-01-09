<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @include('profile.partials.update-profile-information-form')

        <x-section-border />

        @include('profile.partials.update-password-form')

        <x-section-border />

        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
