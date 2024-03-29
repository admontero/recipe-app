<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @include('back.profile.partials.update-profile-information-form')

        <x-section-border />

        @include('back.profile.partials.update-password-form')

        <x-section-border />

        @include('back.profile.partials.delete-user-form')
    </div>
</x-app-layout>
