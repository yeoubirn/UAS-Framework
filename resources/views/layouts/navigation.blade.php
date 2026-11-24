<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-sm border-b border-surface-border shadow-xs sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ Auth::check() && Auth::user()->isAdmin() ? route('admin.services.index') : url('/') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Narendra Media" class="h-10 w-auto object-contain">
                        <span class="font-heading font-bold text-lg text-navy hidden lg:inline-block">Narendra Media</span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop: lg+) -->
                <div class="hidden lg:flex space-x-8 -my-px">
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    @auth
                        @if (Auth::user()->isAdmin())
                            <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                                {{ __('Layanan') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                                {{ __('Pesanan') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('orders.my')" :active="request()->routeIs('orders.my')">
                                {{ __('Pesanan Saya') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings / Auth Dropdown (Desktop: lg+) -->
            <div class="hidden lg:flex items-center ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 border border-surface-border text-sm leading-4 font-medium rounded-md text-navy bg-white hover:bg-sky-50/50 focus:outline-none transition ease-in-out duration-150 max-w-[220px]">
                                <div class="text-left min-w-0 flex-1">
                                    <div class="font-semibold truncate max-w-[140px] text-navy">{{ Auth::user()->name }}</div>
                                    <div class="text-[11px] text-content-secondary flex items-center gap-1.5 mt-0.5">
                                        @if (Auth::user()->isAdmin())
                                            <span class="inline-block px-1.5 py-0.5 rounded bg-purple-100 text-purple-700 font-semibold text-[10px]">Admin</span>
                                        @else
                                            <span class="inline-block px-1.5 py-0.5 rounded bg-cyan-100 text-cyan-800 font-semibold text-[10px]">Pelanggan</span>
                                        @endif
                                    </div>
                                </div>

                                <svg class="fill-current h-4 w-4 text-content-secondary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>

                            @if (!Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('orders.my')">
                                    {{ __('Pesanan Saya') }}
                                </x-dropdown-link>
                            @endif

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
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-content-secondary hover:text-navy transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md shadow-sm transition">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile & Tablet: < lg) -->
            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-content-secondary hover:text-navy hover:bg-sky-50 focus:outline-none transition duration-150 ease-in-out" aria-label="Menu Utama">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile & Tablet: < lg) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-surface-border bg-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>

            @auth
                @if (Auth::user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                        {{ __('Layanan') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                        {{ __('Pesanan') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('orders.my')" :active="request()->routeIs('orders.my')">
                        {{ __('Pesanan Saya') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-3 border-t border-surface-border">
                <div class="px-4 mb-2">
                    <div class="font-semibold text-base text-navy truncate max-w-xs">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-content-secondary truncate">{{ Auth::user()->email }} ({{ ucfirst(Auth::user()->role) }})</div>
                </div>

                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profil Saya') }}
                    </x-responsive-nav-link>

                    @if (!Auth::user()->isAdmin())
                        <x-responsive-nav-link :href="route('orders.my')">
                            {{ __('Pesanan Saya') }}
                        </x-responsive-nav-link>
                    @endif

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
                <a href="{{ route('login') }}" class="block text-center w-full py-2 px-4 text-sm font-semibold text-navy border border-surface-border rounded-md hover:bg-sky-50">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="block text-center w-full py-2 px-4 text-sm font-semibold text-white bg-accent hover:bg-accent-hover rounded-md shadow-sm">
                    Daftar
                </a>
            </div>
        @endauth
    </div>
</nav>
