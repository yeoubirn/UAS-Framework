<x-app-layout>
    <!-- Hero Section (Modern Ambient Glow, Tanpa Garis Kotak Kaku, 2 Kolom dengan Floating Service Cards) -->
    <div class="bg-navy text-white py-14 sm:py-20 border-b border-navy-light relative overflow-hidden">
        <!-- Soft Ambient Glow Effects -->
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-cyan-500/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-orange-500/15 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/3 w-72 h-72 rounded-full bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <!-- Kolom Kiri: Teks & Action Buttons Sesuai Role -->
                <div class="lg:col-span-7 text-left space-y-5">
                    <!-- Role-Aware Trust Pill Badge -->
                    @auth
                        @if (Auth::user()->isAdmin())
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-indigo-500/20 border border-indigo-400/40 text-indigo-200 text-xs sm:text-sm font-medium backdrop-blur-md">
                                <span class="inline-block w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                                <span>Mode Administrator &bull; Panel Pengelolaan Narendra Media</span>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-cyan-500/20 border border-cyan-400/30 text-cyan-300 text-xs sm:text-sm font-medium backdrop-blur-md">
                                <span class="inline-block w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                                <span>Halo, {{ Auth::user()->name }} &bull; Pelanggan Narendra Media</span>
                            </div>
                        @endif
                    @else
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-cyan-300 text-xs sm:text-sm font-medium backdrop-blur-md">
                            <span class="inline-block w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                            <span>Layanan Terpercaya di Tulungagung &bull; Siaga 24 Jam</span>
                        </div>
                    @endauth

                    <!-- Hero Title -->
                    <h1 class="font-heading font-bold text-3xl sm:text-5xl text-white leading-[1.25]">
                        Pasang WiFi, CCTV, dan Rental Proyektor di Tulungagung
                    </h1>

                    <!-- Hero Paragraph -->
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl">
                        Melayani pemasangan dan rental multimedia untuk rumah tinggal, perkantoran, instansi sekolah, dan berbagai penyelenggaraan acara di seluruh wilayah Tulungagung.
                    </p>

                    <!-- Action Buttons: Disesuaikan dengan Role Pengguna -->
                    <div class="pt-2 flex flex-wrap items-center gap-3.5">
                        @auth
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-lg shadow-sm transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Kelola Pesanan Masuk</span>
                                </a>
                                <a href="{{ route('admin.services.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold text-sm rounded-lg transition backdrop-blur-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Kelola Layanan</span>
                                </a>
                            @else
                                <a href="#katalog" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-lg shadow-sm transition">
                                    <span>Lihat Layanan</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <a href="{{ route('orders.my') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold text-sm rounded-lg transition backdrop-blur-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <span>Pesanan Saya</span>
                                </a>
                                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-1.5 px-3 py-3 text-cyan-300 hover:text-white text-xs font-semibold transition">
                                    <span>Konsultasi WhatsApp &rarr;</span>
                                </a>
                            @endif
                        @else
                            <a href="#katalog" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-lg shadow-sm transition">
                                <span>Lihat Layanan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold text-sm rounded-lg transition backdrop-blur-xs">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.073.376-.044.101-.116.433-.506.549-.68.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.203c.044.072.044.419-.1.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.398A9.956 9.956 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" />
                                </svg>
                                <span>Hubungi via WhatsApp</span>
                            </a>
                        @endauth
                    </div>

                    <!-- Trust Points -->
                    <div class="pt-6 border-t border-navy-light/80 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs text-slate-300">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Peralatan Terawat & Siap</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Instalasi Rapi & Berpengalaman</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-cyan-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Harga Terbuka Tanpa Siluman</span>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: 3 Floating Service Cards (Gaya Glassmorphism Halus) -->
                <div class="lg:col-span-5 space-y-3.5 mt-8 lg:mt-0">
                    <!-- Card 1: Rental Proyektor -->
                    <a href="#katalog" class="block p-4 sm:p-5 rounded-xl bg-white/10 backdrop-blur-md border border-white/15 hover:bg-white/15 hover:border-purple-400/40 transition duration-200 shadow-lg group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#7C3AED]/25 border border-[#7C3AED]/50 flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition">
                                📽️
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs uppercase tracking-wider text-purple-300 font-bold">Rental Proyektor</span>
                                    <span class="text-[11px] px-2 py-0.5 rounded-full bg-purple-500/20 text-purple-200 border border-purple-400/30 font-medium">Sewa</span>
                                </div>
                                <div class="text-sm font-semibold text-white mt-0.5 truncate">Layar 3x3 & 4x3 Meter Berkualitas</div>
                                <div class="text-xs text-slate-300 mt-0.5">Mulai Rp 350.000 / acara</div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 2: Pasang CCTV -->
                    <a href="#katalog" class="block p-4 sm:p-5 rounded-xl bg-white/10 backdrop-blur-md border border-white/15 hover:bg-white/15 hover:border-orange-400/40 transition duration-200 shadow-lg group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#EA580C]/25 border border-[#EA580C]/50 flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition">
                                📹
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs uppercase tracking-wider text-orange-300 font-bold">Pasang CCTV</span>
                                    <span class="text-[11px] px-2 py-0.5 rounded-full bg-orange-500/20 text-orange-200 border border-orange-400/30 font-medium">Jasa</span>
                                </div>
                                <div class="text-sm font-semibold text-white mt-0.5 truncate">Paket Lengkap & Jasa Pasang Kamera</div>
                                <div class="text-xs text-slate-300 mt-0.5">Mulai Rp 200.000</div>
                            </div>
                        </div>
                    </a>

                    <!-- Card 3: WiFi & Jaringan -->
                    <a href="#katalog" class="block p-4 sm:p-5 rounded-xl bg-white/10 backdrop-blur-md border border-white/15 hover:bg-white/15 hover:border-cyan-400/40 transition duration-200 shadow-lg group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-[#0891B2]/25 border border-[#0891B2]/50 flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition">
                                📶
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs uppercase tracking-wider text-cyan-300 font-bold">WiFi & Jaringan</span>
                                    <span class="text-[11px] px-2 py-0.5 rounded-full bg-cyan-500/20 text-cyan-200 border border-cyan-400/30 font-medium">Jasa</span>
                                </div>
                                <div class="text-sm font-semibold text-white mt-0.5 truncate">Instalasi Kantor, Sekolah & Rumah</div>
                                <div class="text-xs text-slate-300 mt-0.5">Mulai Rp 350.000</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Baris Info di Bawah Hero (Luwes & Bersih Tanpa Garis Pembatas Kaku) -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5">
            <div class="flex flex-wrap items-center justify-start text-xs sm:text-sm text-content-secondary gap-y-2">
                <span class="font-semibold text-content-primary">Buka 24 Jam</span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300 mx-3 sm:mx-4"></span>
                <span>Besuki, Tulungagung</span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300 mx-3 sm:mx-4"></span>
                <a href="mailto:ekowawan818@gmail.com" class="text-primary-dark font-medium hover:underline">ekowawan818@gmail.com</a>
            </div>
        </div>
    </div>

    <!-- Section Keunggulan Layanan (Desain Baru: Multi-Accent Cards dengan Rounded Luwes) -->
    <div class="py-14 sm:py-18 bg-surface-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-cyan-100 text-[#0891B2]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#0891B2]"></span>
                    Nilai Keunggulan
                </span>
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-navy leading-[1.3] mt-2">
                    Solusi Tepat untuk Kebutuhan Acara & Jaringan
                </h2>
                <p class="text-sm sm:text-base text-content-secondary mt-1 max-w-xl">
                    Tiga komitmen Narendra Media untuk memastikan seluruh kebutuhan Anda terpenuhi secara profesional di Tulungagung.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Keunggulan 1: Aksen Cyan (#0891B2) -->
                <div class="group relative bg-white rounded-2xl p-7 border border-sky-100 shadow-[0_4px_20px_rgba(6,182,212,0.06)] hover:shadow-[0_8px_30px_rgba(6,182,212,0.14)] hover:-translate-y-1 transition duration-200">
                    <div class="absolute top-0 left-6 right-6 h-1 bg-gradient-to-r from-cyan-400 to-[#0891B2] rounded-full"></div>
                    <div class="w-12 h-12 rounded-xl bg-cyan-50 text-[#0891B2] flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition">
                        ⚡
                    </div>
                    <h3 class="font-heading font-bold text-lg text-navy">Layanan Siap 24 Jam</h3>
                    <p class="mt-2.5 text-xs sm:text-sm text-content-secondary leading-relaxed">
                        Kami buka dan siap melayani kapan saja. Sangat pas untuk kebutuhan acara mendadak maupun penanganan jaringan yang butuh segera.
                    </p>
                </div>

                <!-- Keunggulan 2: Aksen Oranye (#F97316) -->
                <div class="group relative bg-white rounded-2xl p-7 border border-orange-100 shadow-[0_4px_20px_rgba(249,115,22,0.06)] hover:shadow-[0_8px_30px_rgba(249,115,22,0.14)] hover:-translate-y-1 transition duration-200">
                    <div class="absolute top-0 left-6 right-6 h-1 bg-gradient-to-r from-[#F97316] to-[#EA580C] rounded-full"></div>
                    <div class="w-12 h-12 rounded-xl bg-orange-50 text-[#F97316] flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition">
                        🛡️
                    </div>
                    <h3 class="font-heading font-bold text-lg text-navy">Peralatan Terawat & Rapi</h3>
                    <p class="mt-2.5 text-xs sm:text-sm text-content-secondary leading-relaxed">
                        Proyektor jernih dengan layar kokoh, serta instalasi CCTV dan kabel jaringan yang tertata rapi sesuai standar teknis.
                    </p>
                </div>

                <!-- Keunggulan 3: Aksen Ungu (#7C3AED) -->
                <div class="group relative bg-white rounded-2xl p-7 border border-purple-100 shadow-[0_4px_20px_rgba(124,58,237,0.06)] hover:shadow-[0_8px_30px_rgba(124,58,237,0.14)] hover:-translate-y-1 transition duration-200">
                    <div class="absolute top-0 left-6 right-6 h-1 bg-gradient-to-r from-purple-400 to-[#7C3AED] rounded-full"></div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-[#7C3AED] flex items-center justify-center text-xl mb-5 group-hover:scale-110 transition">
                        🏷️
                    </div>
                    <h3 class="font-heading font-bold text-lg text-navy">Harga Terbuka & Ramah</h3>
                    <p class="mt-2.5 text-xs sm:text-sm text-content-secondary leading-relaxed">
                        Daftar harga tertera jelas per hari atau per titik pasang. Tanpa biaya tersembunyi sehingga mudah disesuaikan dengan anggaran.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Alur Pemesanan (Desain Baru: Alur Terhubung Luwes Tanpa Garis Kaku) -->
    <div class="py-14 sm:py-18 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-left mb-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-orange-100 text-[#EA580C]">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#EA580C]"></span>
                    Alur Pemesanan
                </span>
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-navy leading-[1.3] mt-2">
                    3 Langkah Mudah Memesan Layanan
                </h2>
                <p class="text-sm sm:text-base text-content-secondary mt-1">
                    Proses pemesanan terhubung yang praktis dan cepat langsung dari perangkat Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Step 1 -->
                <div class="bg-surface-bg/80 backdrop-blur-sm rounded-2xl p-7 border border-sky-100 shadow-xs hover:bg-surface-bg hover:shadow-sm transition flex flex-col items-start">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-navy to-navy-light text-white flex items-center justify-center font-heading font-bold text-lg shadow-md mb-4 shrink-0">
                        01
                    </div>
                    <span class="text-[11px] font-bold text-primary-dark uppercase tracking-wider">Langkah 1</span>
                    <h3 class="font-heading font-bold text-base sm:text-lg text-navy mt-1">Pilih Layanan</h3>
                    <p class="mt-2 text-xs sm:text-sm text-content-secondary leading-relaxed">
                        Tentukan kebutuhan Anda, mulai dari sewa proyektor acara, pemasangan CCTV keamanan, atau instalasi WiFi kantor/sekolah.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-surface-bg/80 backdrop-blur-sm rounded-2xl p-7 border border-sky-100 shadow-xs hover:bg-surface-bg hover:shadow-sm transition flex flex-col items-start">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-accent to-[#EA580C] text-white flex items-center justify-center font-heading font-bold text-lg shadow-md mb-4 shrink-0">
                        02
                    </div>
                    <span class="text-[11px] font-bold text-[#EA580C] uppercase tracking-wider">Langkah 2</span>
                    <h3 class="font-heading font-bold text-base sm:text-lg text-navy mt-1">Tentukan Tanggal & Alamat</h3>
                    <p class="mt-2 text-xs sm:text-sm text-content-secondary leading-relaxed">
                        Pilih tanggal pemakaian atau pemasangan, masukkan alamat lengkap lokasi Anda di wilayah Tulungagung, dan kirim pesanan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-surface-bg/80 backdrop-blur-sm rounded-2xl p-7 border border-sky-100 shadow-xs hover:bg-surface-bg hover:shadow-sm transition flex flex-col items-start">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-dark to-primary text-white flex items-center justify-center font-heading font-bold text-lg shadow-md mb-4 shrink-0">
                        03
                    </div>
                    <span class="text-[11px] font-bold text-primary-dark uppercase tracking-wider">Langkah 3</span>
                    <h3 class="font-heading font-bold text-base sm:text-lg text-navy mt-1">Konfirmasi & Pengerjaan</h3>
                    <p class="mt-2 text-xs sm:text-sm text-content-secondary leading-relaxed">
                        Pemilik Narendra Media akan segera mengonfirmasi pesanan Anda dan teknisi langsung bersiap datang sesuai jadwal.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Layanan Section Dikelompokkan Per Kategori (Sesuai Aturan BRIEF.md) -->
    <div id="katalog" class="py-14 sm:py-20 bg-surface-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12 text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-cyan-100 text-primary-dark">
                    <span class="w-1.5 h-1.5 rounded-full bg-primary-dark"></span>
                    Pilihan Lengkap
                </span>
                <h2 class="font-heading font-bold text-2xl sm:text-3xl text-navy leading-[1.3] mt-2">
                    Katalog Layanan
                </h2>
                <p class="text-sm sm:text-base text-content-secondary mt-1 max-w-xl">
                    Pilihan layanan multimedia, rental proyektor, pemasangan CCTV, dan jaringan internet dari Narendra Media.
                </p>
            </div>

            @php
                $groupedServices = $servicesByCategory ?? \App\Models\Service::all()->groupBy(fn($s) => $s->category->nama ?? 'Lainnya');
                $categoryBorderColor = function($cat) {
                    if (str_contains($cat, 'Proyektor')) return '#7C3AED';
                    if (str_contains($cat, 'CCTV')) return '#EA580C';
                    return '#0891B2';
                };
            @endphp

            @forelse ($groupedServices as $kategori => $services)
                <div class="mb-14">
                    <!-- Header Kategori: border tebal 4px di sisi kiri, tanpa lencana/ikon lingkaran (Sesuai BRIEF.md) -->
                    <div class="flex items-center justify-between pb-3.5 mb-7 border-b border-surface-border">
                        <div class="flex items-center pl-3.5" style="border-left: 4px solid {{ $categoryBorderColor($kategori) }};">
                            <h3 class="font-heading font-bold text-xl sm:text-2xl text-navy leading-[1.3]">
                                {{ $kategori }}
                            </h3>
                        </div>
                        <!-- Jumlah layanan: teks abu polos kecil ("X layanan") tanpa kotak (Sesuai BRIEF.md) -->
                        <span class="text-xs text-content-secondary font-medium">
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
                <div class="bg-surface-card rounded-2xl border border-surface-border p-12 text-center shadow-xs">
                    <p class="text-content-secondary text-sm">Belum ada layanan yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
