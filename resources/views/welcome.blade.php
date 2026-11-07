<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-blue-50/60 to-surface-bg py-12 sm:py-16 border-b border-surface-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-block px-3.5 py-1.5 bg-blue-50 text-primary font-semibold text-xs rounded-full border border-blue-200 tracking-wide mb-5">
                    Jasa & Rental Tulungagung • Buka 24 Jam
                </span>
                <h1 class="font-heading font-bold text-3xl sm:text-5xl text-content-primary tracking-tight leading-tight">
                    Solusi Digital & Rental Multimedia Terpercaya
                </h1>
                <p class="mt-4 text-base sm:text-lg text-content-secondary leading-relaxed">
                    Narendra Media melayani rental proyektor layar besar, paket pasang CCTV, serta instalasi WiFi & jaringan perkantoran dan sekolah dengan teknisi handal dan harga terjangkau.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                    @auth
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.services.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold rounded-xl shadow-sm transition">
                                Kelola Layanan Admin
                            </a>
                        @else
                            <a href="{{ route('orders.my') }}" class="inline-flex items-center justify-center px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold rounded-xl shadow-sm transition">
                                Lihat Pesanan Saya
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold rounded-xl shadow-sm transition">
                            Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white hover:bg-gray-50 text-content-primary border border-surface-border font-semibold rounded-xl shadow-sm transition">
                            Masuk ke Akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Layanan Section Dikelompokkan Per Kategori -->
    <div class="py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center sm:text-left">
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-content-primary">
                    Katalog Layanan
                </h2>
                <p class="text-sm sm:text-base text-content-secondary mt-1">
                    Pilihan layanan multimedia, rental proyektor, CCTV, dan jaringan internet dari Narendra Media.
                </p>
            </div>

            @php
                $groupedServices = $servicesByCategory ?? \App\Models\Service::all()->groupBy('kategori');
            @endphp

            @forelse ($groupedServices as $kategori => $services)
                <div class="mb-12">
                    <!-- Header Kategori -->
                    <div class="flex items-center justify-between pb-3 mb-6 border-b border-surface-border">
                        <div class="flex items-center gap-3">
                            <span class="w-2.5 h-6 bg-primary rounded-full"></span>
                            <h3 class="font-heading font-bold text-xl sm:text-2xl text-content-primary">
                                {{ $kategori }}
                            </h3>
                        </div>
                        <span class="text-xs font-semibold px-3 py-1 bg-blue-50 text-primary border border-blue-100 rounded-full">
                            {{ $services->count() }} Layanan
                        </span>
                    </div>

                    <!-- Grid Kartu Layanan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($services as $service)
                            <x-service-card :service="$service" />
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl border border-surface-border p-12 text-center">
                    <p class="text-content-secondary">Belum ada layanan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
