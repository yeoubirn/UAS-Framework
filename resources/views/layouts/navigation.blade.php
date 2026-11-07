<nav x-data="{ open: false }" class="bg-white border-b border-surface-border sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() && Auth::user()->isAdmin() ? route('admin.services.index') : url('/') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Narendra Media" class="h-10 w-auto object-contain">
                        <span class="font-heading font-bold text-lg text-content-primary hidden sm:inline-block">Narendra Media</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @auth
                        @if (Auth::user()->isAdmin())
                            <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                                {{ __('Layanan') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                                {{ __('Pesanan') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings / Auth Dropdown (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-surface-border text-sm leading-4 font-medium rounded-lg text-content-primary bg-white hover:bg-gray-50 focus:outline-none transition ease-in-out duration-150">
                                <div class="text-left me-2">
                                    <div class="font-semibold">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-content-secondary capitalize">{{ Auth::user()->role }}</div>
                                </div>

                                <svg class="fill-current h-4 w-4 text-content-secondary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="text-red-600 hover:text-red-700">
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-content-secondary hover:text-primary transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-content-secondary hover:text-content-primary hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" aria-label="Menu Utama">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-surface-border bg-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @auth
                @if (Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                        {{ __('Layanan') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                        {{ __('Pesanan') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-3 border-t border-surface-border">
                <div class="px-4 mb-2">
                    <div class="font-medium text-base text-content-primary">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-content-secondary">{{ Auth::user()->email }} ({{ ucfirst(Auth::user()->role) }})</div>
                </div>

                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profil Saya') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-red-600">
                            {{ __('Keluar') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-surface-border px-4 space-y-2">
                <a href="{{ route('login') }}" class="block text-center w-full py-2 px-4 text-sm font-medium text-content-primary border border-surface-border rounded-lg hover:bg-gray-50">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="block text-center w-full py-2 px-4 text-sm font-semibold text-white bg-accent hover:bg-accent-hover rounded-lg shadow-sm">
                    Daftar
                </a>
            </div>
        @endauth
    </div>
</nav>
