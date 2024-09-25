<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-text-input id="name" class="button-pill" type="text" name="name" placeholder="Naam" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <br><br><br>

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="button-pill" type="email" name="email" placeholder="Email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <br><br><br>

        <!-- Password -->
        <div>

            <x-text-input id="password" class="button-pill"
                            type="password"
                            name="password"
                            placeholder="Wachtwoord"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <br><br><br>

        <!-- Confirm Password -->
        <div>

            <x-text-input id="password_confirmation" class="button-pill"
                            type="password"
                            placeholder="Wachtwoord herhalen"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <br><br><br><br><br><br>

        <x-primary-button class="button-pill">
            {{ __('Registreren') }}
        </x-primary-button>
        <br><br><br>

        <div style="position:absolute; bottom: 20%; left: 6.9%">
            <button class="button-pill-auth-ctrl">
            <a  href="{{ route('login') }}">
                {{ __('Heeft u al een account?') }}
            </a>
            </button>
        </div>
    </form>
</x-guest-layout>
