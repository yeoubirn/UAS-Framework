<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h1 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
            Masuk ke Akun
        </h1>
        <p class="text-xs text-content-secondary mt-1">
            Silakan masukkan email dan kata sandi Anda untuk melanjutkan
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="email@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Kata sandi Anda" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-surface-border text-primary focus:ring-primary shadow-sm" name="remember">
                <span class="ms-2 text-sm text-content-secondary">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-xs text-content-secondary hover:text-navy underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" href="{{ route('password.request') }}">
                    {{ __('Lupa kata sandi?') }}
                </a>
            @else
                <span></span>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div class="mt-6 pt-5 border-t border-surface-border text-center text-xs text-content-secondary">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-primary-dark hover:underline ms-1">
                    Daftar di sini
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
