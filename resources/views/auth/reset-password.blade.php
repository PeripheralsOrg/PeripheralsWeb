<x-guest-layout>
    <x-authentication-card class="background">
        <x-slot name="logo">
            <a href="{{ route('client-homepage') }}">
                <img src="{{ asset('images/logo-peripherals.jpeg') }}" alt="Logo Peripherals">
            </a>
        </x-slot>

        <x-validation-errors class="mb-4 not-black error-box" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/home/forgot-password.css') }}">

        <form method="POST" action="{{ route('password.update') }}" class="not-black">
            @csrf

            <input type="hidden" name="token" value="{{ Request::route('token') }}">

            <div class="block not-black">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', Request::input('email'))" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 not-black">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4 not-black">
                <x-label for="password_confirmation" value="{{ __('Confirmar Senha') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4 not-black">
                <x-button class="reset-pass">
                    {{ __('Resetar Senha') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
