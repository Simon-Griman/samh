@section('title', 'Perfil')

<x-app-layout>
    <img src="{{ url('storage/profile-photos/cintillo_osti.jpg') }}" alt="" class="w-100">
    {{--<x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>--}}

    <div>
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')

            <x-jet-section-border />
        @endif

        {{--@if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            @livewire('profile.two-factor-authentication-form')

            <x-jet-section-border />
        @endif--}}

        @livewire('profile.logout-other-browser-sessions-form')

        
    </div>
</x-app-layout>
