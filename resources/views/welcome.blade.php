<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-navy bg-hero-grid text-white py-14 sm:py-20 border-b border-navy-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl text-left">
                <h1 class="font-heading font-bold text-3xl sm:text-5xl text-white leading-[1.3]">
                    Pasang WiFi, CCTV, dan Rental Proyektor di Tulungagung
                </h1>
                <p class="mt-5 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl">
                    Melayani pemasangan dan rental multimedia untuk rumah tinggal, perkantoran, instansi sekolah, dan berbagai penyelenggaraan acara di seluruh wilayah Tulungagung.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="#katalog" class="inline-flex items-center justify-center px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-md shadow-sm transition">
                        Lihat Layanan
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-6 py-3 bg-transparent hover:bg-white/10 text-white border border-white font-semibold text-sm rounded-md transition">
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Bar Polos -->
    <div class="bg-white border-b border-surface-border">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5">
            <div class="flex flex-wrap items-center justify-start text-xs sm:text-sm text-content-secondary gap-y-2">
                <span class="font-medium text-content-primary">Buka 24 jam</span>
                <span class="mx-3 sm:mx-4 h-4 w-px bg-surface-border"></span>
                <span>Besuki, Tulungagung</span>
                <span class="mx-3 sm:mx-4 h-4 w-px bg-surface-border"></span>
                <a href="mailto:ekowawan818@gmail.com" class="text-primary-dark hover:underline">ekowawan818@gmail.com</a>
            </div>
        </div>
    </div>

    <!-- Layanan Section Dikelompokkan Per Kategori -->
    <div id="katalog" class="py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-left">
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-navy leading-[1.3]">
                    Katalog Layanan
                </h2>
                <p class="text-sm sm:text-base text-content-secondary mt-2">
                    Pilihan layanan multimedia, rental proyektor, pemasangan CCTV, dan jaringan internet dari Narendra Media.
                </p>
            </div>

            @php
                $groupedServices = $servicesByCategory ?? \App\Models\Service::all()->groupBy('kategori');
                $categoryBorderColor = function($cat) {
                    if (str_contains($cat, 'Proyektor')) return '#7C3AED';
                    if (str_contains($cat, 'CCTV')) return '#EA580C';
                    return '#0891B2';
                };
            @endphp

            @forelse ($groupedServices as $kategori => $services)
                <div class="mb-12">
                    <!-- Header Kategori: border tebal 4px di sisi kiri, tanpa lencana/ikon lingkaran -->
                    <div class="flex items-center justify-between pb-3 mb-6 border-b border-surface-border">
                        <div class="flex items-center pl-3" style="border-left: 4px solid {{ $categoryBorderColor($kategori) }};">
                            <h3 class="font-heading font-bold text-xl sm:text-2xl text-navy leading-[1.3]">
                                {{ $kategori }}
                            </h3>
                        </div>
                        <span class="text-xs text-content-secondary">
                            {{ $services->count() }} layanan
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
                <div class="bg-surface-card rounded-lg border border-surface-border p-12 text-center">
                    <p class="text-content-secondary">Belum ada layanan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
