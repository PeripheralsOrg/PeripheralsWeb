<x-guest-layout>
    <x-authentication-card class="background">
        <x-slot name="logo">
            <a href="{{ route('client-homepage') }}">
                <img src="{{ asset('images/logo-peripherals.jpeg') }}" alt="Logo Peripherals">
            </a>
        </x-slot>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/home/forgot-password.css') }}">

        <div class="mb-4 text-sm text-gray-600 not-black">
            {{-- {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }} --}}
            {{ __('Esqueceu sua senha? Sem problemas. Apenas nos informe seu email e lhe enviaremos o seu link de restauração de senha, que irá permitir que você escolha uma nova.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 not-black">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4 error-box" />

        <form method="POST" class="not-black" action="{{ route('password.email') }}">
            @csrf

            <div class="block not-black">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4 not-black">
                <x-button class="reset-pass">
                    {{ __('Link de restauração de senha') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
