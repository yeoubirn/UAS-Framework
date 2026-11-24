<x-app-layout>
    @php
        $categoryName = $service->category->nama ?? $service->kategori ?? 'Umum';
        $catBgClass = 'bg-[#0891B2]';
        $catBorderColor = '#0891B2';
        if (str_contains($categoryName, 'Proyektor')) {
            $catBgClass = 'bg-[#7C3AED]';
            $catBorderColor = '#7C3AED';
        } elseif (str_contains($categoryName, 'CCTV')) {
            $catBgClass = 'bg-[#EA580C]';
            $catBorderColor = '#EA580C';
        }
    @endphp

    <div class="py-8 sm:py-12 bg-surface-bg min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-content-secondary hover:text-navy transition">
                    <svg class="w-4 h-4 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Katalog Layanan</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Kolom Kiri: Detail Layanan (Inspirasi Showcase RajaWeb) -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="bg-surface-card rounded-lg border border-surface-border overflow-hidden shadow-xs">
                        <!-- Gambar / Ilustrasi Layanan (Placeholder blok solid sesuai kategori sesuai BRIEF.md) -->
                        <div class="relative w-full h-64 sm:h-80 overflow-hidden flex items-center justify-center">
                            @if ($service->gambar && file_exists(public_path($service->gambar)))
                                <img src="{{ asset($service->gambar) }}" alt="{{ $service->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full {{ $catBgClass }} flex flex-col items-center justify-center p-6 text-center">
                                    <span class="font-heading font-bold text-white text-2xl sm:text-3xl tracking-wide drop-shadow-xs">
                                        {{ $categoryName }}
                                    </span>
                                    <span class="text-xs text-white/80 mt-2 font-medium">Narendra Media Tulungagung</span>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-md {{ $catBgClass }} text-white uppercase tracking-wider shadow-xs">
                                    {{ $service->tipe }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8">
                            <div class="pl-3 mb-3" style="border-left: 4px solid {{ $catBorderColor }};">
                                <span class="text-xs font-semibold text-content-secondary uppercase tracking-wider">
                                    {{ $categoryName }}
                                </span>
                            </div>

                            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy leading-[1.3] mt-1">
                                {{ $service->nama }}
                            </h1>

                            <div class="mt-4 pb-6 border-b border-surface-border flex flex-wrap items-baseline justify-between gap-2">
                                <div>
                                    <span class="text-xs text-content-secondary uppercase tracking-wider font-semibold block">Biaya Layanan:</span>
                                    <div class="font-heading font-bold text-2xl sm:text-3xl text-navy mt-1">
                                        Rp {{ number_format($service->harga, 0, ',', '.') }}
                                        <span class="text-sm font-normal text-content-secondary capitalize">/ {{ $service->tipe }}</span>
                                    </div>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Siap Dipesan
                                </span>
                            </div>

                            <div class="mt-6">
                                <h2 class="font-heading font-bold text-base sm:text-lg text-navy mb-3 leading-[1.3]">
                                    Deskripsi & Cakupan Layanan
                                </h2>
                                <p class="text-content-secondary text-sm sm:text-base leading-relaxed whitespace-pre-line">
                                    {{ $service->deskripsi }}
                                </p>
                            </div>

                            <!-- Fitur Unggulan Layanan ala RajaWeb -->
                            <div class="mt-8 pt-6 border-t border-surface-border grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-content-secondary">
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Peralatan Dicek Sebelum Dikirim</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Teknisi Berpengalaman & Rapi</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Melayani Seluruh Tulungagung</span>
                                </div>
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Dukungan Operasional 24 Jam</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Usaha Narendra Media -->
                    <div class="bg-white border border-surface-border rounded-lg p-6">
                        <h3 class="font-heading font-bold text-sm sm:text-base text-navy mb-3 leading-[1.3]">
                            Informasi Layanan Narendra Media
                        </h3>
                        <ul class="space-y-2.5 text-xs sm:text-sm text-content-secondary">
                            <li class="flex items-start gap-2.5">
                                <span class="text-primary-dark font-bold mt-0.5">•</span>
                                <span>Operasional 24 jam siap melayani kebutuhan acara dan pekerjaan teknis Anda.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-primary-dark font-bold mt-0.5">•</span>
                                <span>Wilayah kerja: Seluruh area Tulungagung (rumah tinggal, kantor, sekolah, hingga gedung acara).</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="text-primary-dark font-bold mt-0.5">•</span>
                                <span>Konsultasi cepat via WhatsApp: <a href="https://wa.me/6281234567890" target="_blank" class="text-primary-dark font-semibold hover:underline">0812-3456-7890</a> atau email: <a href="mailto:ekowawan818@gmail.com" class="text-primary-dark font-semibold hover:underline">ekowawan818@gmail.com</a></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Pemesanan -->
                <div class="lg:col-span-5">
                    <div class="bg-surface-card rounded-lg border border-surface-border p-6 sm:p-7 sticky top-24 shadow-xs">
                        <div class="border-b border-surface-border pb-4 mb-5">
                            <span class="text-xs font-bold uppercase tracking-wider text-primary-dark">Pesan Langsung</span>
                            <h2 class="font-heading font-bold text-xl text-navy leading-[1.3] mt-1">
                                Form Pemesanan
                            </h2>
                            <p class="text-xs text-content-secondary mt-1">
                                Satu pesanan untuk satu layanan. Total biaya dihitung otomatis oleh sistem.
                            </p>
                        </div>

                        @auth
                            <!-- Form Pesan untuk User yang Login -->
                            <form action="{{ route('orders.store', $service) }}" method="POST" x-data="{ jumlah: {{ old('jumlah', 1) }}, harga: {{ $service->harga }} }">
                                @csrf

                                <!-- Jumlah -->
                                <div class="mb-4">
                                    <label for="jumlah" class="block text-xs sm:text-sm font-semibold text-content-primary mb-1">
                                        Jumlah <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                           id="jumlah"
                                           name="jumlah"
                                           x-model.number="jumlah"
                                           min="1"
                                           value="{{ old('jumlah', 1) }}"
                                           required
                                           class="w-full rounded-md border-surface-border focus:border-primary focus:ring-primary text-sm">
                                    <x-input-error :messages="$errors->get('jumlah')" class="mt-1" />
                                </div>

                                <!-- Tanggal -->
                                <div class="mb-4">
                                    <label for="tanggal" class="block text-xs sm:text-sm font-semibold text-content-primary mb-1">
                                        Tanggal Pemakaian / Pemasangan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date"
                                           id="tanggal"
                                           name="tanggal"
                                           value="{{ old('tanggal') }}"
                                           required
                                           class="w-full rounded-md border-surface-border focus:border-primary focus:ring-primary text-sm">
                                    <x-input-error :messages="$errors->get('tanggal')" class="mt-1" />
                                </div>

                                <!-- Alamat -->
                                <div class="mb-4">
                                    <label for="alamat" class="block text-xs sm:text-sm font-semibold text-content-primary mb-1">
                                        Alamat Lengkap di Tulungagung <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="alamat"
                                              name="alamat"
                                              rows="3"
                                              required
                                              placeholder="Masukkan alamat lengkap lokasi acara atau pemasangan..."
                                              class="w-full rounded-md border-surface-border focus:border-primary focus:ring-primary text-sm">{{ old('alamat') }}</textarea>
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                                </div>

                                <!-- Catatan -->
                                <div class="mb-5">
                                    <label for="catatan" class="block text-xs sm:text-sm font-semibold text-content-primary mb-1">
                                        Catatan Tambahan <span class="text-xs text-content-secondary font-normal">(opsional)</span>
                                    </label>
                                    <textarea id="catatan"
                                              name="catatan"
                                              rows="2"
                                              placeholder="Contoh: Jam mulai acara, patokan rumah, rincian penarikan kabel, dsb."
                                              class="w-full rounded-md border-surface-border focus:border-primary focus:ring-primary text-sm">{{ old('catatan') }}</textarea>
                                    <x-input-error :messages="$errors->get('catatan')" class="mt-1" />
                                </div>

                                <!-- Kalkulasi Estimasi Total ala RajaWeb -->
                                <div class="p-4 bg-sky-50/70 rounded-md border border-surface-border mb-5">
                                    <div class="flex justify-between items-center text-xs text-content-secondary mb-1">
                                        <span>Tarif per unit:</span>
                                        <span class="font-medium text-navy">Rp {{ number_format($service->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-baseline pt-2 border-t border-surface-border">
                                        <span class="text-xs sm:text-sm font-semibold text-content-primary">Estimasi Total:</span>
                                        <span class="font-heading font-bold text-lg sm:text-xl text-navy">
                                            Rp <span x-text="((jumlah > 0 ? jumlah : 1) * harga).toLocaleString('id-ID')"></span>
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-content-secondary mt-1.5 leading-relaxed">
                                        * Total resmi dihitung otomatis di server. Status awal pesanan: <span class="font-semibold text-amber-600">Pending</span>.
                                    </p>
                                </div>

                                <!-- Tombol Kirim Pesanan -->
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-md transition shadow-xs">
                                    <span>Pesan Layanan Sekarang</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </button>
                            </form>
                        @else
                            <!-- Box untuk Tamu / User Belum Login -->
                            <div class="text-center py-6 px-4 bg-white border border-surface-border rounded-md">
                                <div class="w-12 h-12 rounded-full bg-cyan-50 border border-cyan-200 text-primary-dark mx-auto flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 class="font-heading font-bold text-base text-navy">
                                    Silakan Masuk untuk Memesan
                                </h3>
                                <p class="text-xs text-content-secondary mt-1.5 leading-relaxed">
                                    Masuk ke akun Anda untuk melakukan pemesanan layanan secara online.
                                </p>

                                <div class="mt-5 space-y-2">
                                    <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-5 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md transition shadow-xs">
                                        Masuk ke Akun
                                    </a>
                                    <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center px-5 py-2 bg-transparent text-primary-dark border border-primary text-xs font-semibold rounded-md hover:bg-sky-50 transition">
                                        Belum punya akun? Daftar
                                    </a>
                                </div>
                            </div>
                        @endauth

                        <!-- WhatsApp Help Line -->
                        <div class="mt-5 pt-4 border-t border-surface-border text-center">
                            <span class="text-xs text-content-secondary">Ada pertanyaan sebelum memesan?</span>
                            <div class="mt-1">
                                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                        <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.073.376-.044.101-.116.433-.506.549-.68.116-.173.231-.144.39-.086s1.011.477 1.184.564.289.13.332.203c.044.072.044.419-.1.824zM12 2C6.477 2 2 6.477 2 12c0 1.891.524 3.66 1.434 5.176L2 22l4.957-1.398A9.956 9.956 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2z" />
                                    </svg>
                                    <span>Konsultasi Cepat via WhatsApp</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
