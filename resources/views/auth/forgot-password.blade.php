<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
              <img src="img/avans_aad_logo.png" id="login_logo" class="fill-current text-gray-500"/>
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Wachtwoord vergeten? Geen probleem. Laat ons je email adres weten en we sturen je een email om je wachtwoord te resetten.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Wachtwoord Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
