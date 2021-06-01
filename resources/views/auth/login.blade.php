<x-guest-layout>
  <x-auth-card>
    <x-slot name="logo">
      <a href="/">
        <img src="img/avans_aad_logo.png" id="login_logo" class="fill-current text-gray-500" />
      </a>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
      <div>
        <x-label for="email" :value="__('Email')" />

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus data-bs-toggle="tooltip"
                 data-bs-placement="right" title="Vul hier het e-mail adres in waarmee je dit account hebt geregisteerd" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-label for="password" :value="__('Wachtwoord')" />

        <x-input id="password" class="block mt-1 w-full"
                 type="password"
                 name="password"
                 required autocomplete="current-password"
                 data-bs-toggle="tooltip" data-bs-placement="right" title="Vul hier het wachtwoord in die je hebt aangemaakt bij het registreren van je account" />
      </div>

      <!-- Remember Me -->
      <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
          <span class="ml-2 text-sm text-gray-600">{{ __('Onthoudt mij') }}</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
          {{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
          {{--                        {{ __('Wachtwoord vergeten?') }}--}}
          {{--                    </a>--}}
        @endif
        <a href="/register">
          Registreren
        </a>
        <x-button class="ml-3" >
          {{ __('Log in') }}
        </x-button>
      </div>
    </form>
  </x-auth-card>
</x-guest-layout>
