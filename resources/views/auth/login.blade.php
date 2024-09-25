<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-text-input placeholder="Email addres" class="inputEmail" id="email" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <br><br><br>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input id="password" class="inputPasswd"
                            type="password"
                            name="password"
                            placeholder="Wachtwoord"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <br><br><br>
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400" style="color: #bd0926">{{ __('Blijf Ingelogd') }}</span>
            </label>
        </div>
        <div class="loginBottom">
            <x-primary-button class="button-pill">
                {{ __('Inloggen') }}
            </x-primary-button>
            <br><br><br>
        </div>
        <div style="position:absolute; bottom: 50%; left: 10%">
            @if (Route::has('password.request'))
                <button class="button-pill-auth-ctrl">
                <a class="" href="{{ route('password.request') }}">
                    {{ __('Wachtwoord vergeten?') }}
                </a>
                </button>
            @endif
        </div>

        </div>

    </form>
    <div style="position:absolute; bottom: 28%; left: 10%">
    <button class="button-pill-auth-ctrl">
        <a class="" href="{{ route('register') }}" style="font-weight: bold">
            {{ __('Nog geen account?') }}
        </a>
    </button>
    </div>
</x-guest-layout>
