<x-app-layout>
    @php
        $catBgClass = 'bg-[#0891B2]';
        $catBorderColor = '#0891B2';
        if (str_contains($service->kategori, 'Proyektor')) {
            $catBgClass = 'bg-[#7C3AED]';
            $catBorderColor = '#7C3AED';
        } elseif (str_contains($service->kategori, 'CCTV')) {
            $catBgClass = 'bg-[#EA580C]';
            $catBorderColor = '#EA580C';
        }
    @endphp

    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-medium text-content-secondary hover:text-navy transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Katalog Layanan</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Kolom Kiri: Detail Layanan -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="bg-surface-card rounded-lg border border-surface-border overflow-hidden">
                        <!-- Gambar / Ilustrasi Layanan (Placeholder blok solid sesuai kategori) -->
                        <div class="relative w-full h-64 sm:h-80 overflow-hidden flex items-center justify-center">
                            @if ($service->gambar && file_exists(public_path($service->gambar)))
                                <img src="{{ asset($service->gambar) }}" alt="{{ $service->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full {{ $catBgClass }} flex items-center justify-center p-6 text-center">
                                    <span class="font-heading font-bold text-white text-2xl tracking-wide">
                                        {{ $service->kategori }}
                                    </span>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-md {{ $catBgClass }} text-white uppercase tracking-wider">
                                    {{ $service->tipe }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8">
                            <div class="pl-3 mb-3" style="border-left: 4px solid {{ $catBorderColor }};">
                                <span class="text-xs font-semibold text-content-secondary uppercase tracking-wider">
                                    {{ $service->kategori }}
                                </span>
                            </div>

                            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-navy leading-[1.3] mt-1">
                                {{ $service->nama }}
                            </h1>

                            <div class="mt-4 pb-6 border-b border-surface-border">
                                <span class="text-xs text-content-secondary uppercase tracking-wider font-semibold">Biaya Layanan:</span>
                                <div class="font-heading font-bold text-2xl sm:text-3xl text-navy mt-1">
                                    Rp {{ number_format($service->harga, 0, ',', '.') }}
                                    <span class="text-sm font-normal text-content-secondary capitalize">/ {{ $service->tipe }}</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h2 class="font-heading font-semibold text-lg text-navy mb-3 leading-[1.3]">
                                    Deskripsi Layanan
                                </h2>
                                <p class="text-content-secondary text-base leading-relaxed whitespace-pre-line">
                                    {{ $service->deskripsi }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Usaha Narendra Media -->
                    <div class="bg-white border border-surface-border rounded-lg p-6">
                        <h3 class="font-heading font-semibold text-base text-navy mb-3 leading-[1.3]">
                            Informasi Layanan Narendra Media
                        </h3>
                        <ul class="space-y-2 text-sm text-content-secondary">
                            <li class="flex items-center gap-2">
                                <span class="text-primary-dark font-bold">•</span>
                                <span>Operasional 24 jam siap melayani kebutuhan Anda</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-primary-dark font-bold">•</span>
                                <span>Wilayah kerja: Tulungagung dan sekitarnya (rumah, kantor, sekolah, dan acara)</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-primary-dark font-bold">•</span>
                                <span>Kontak & konsultasi: ekowawan818@gmail.com</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Pemesanan -->
                <div class="lg:col-span-5">
                    <div class="bg-surface-card rounded-lg border border-surface-border p-6 sm:p-7 sticky top-24">
                        <div class="border-b border-surface-border pb-4 mb-5">
                            <h2 class="font-heading font-bold text-xl text-navy leading-[1.3]">
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
                                    <label for="jumlah" class="block text-sm font-semibold text-content-primary mb-1">
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
                                    <label for="tanggal" class="block text-sm font-semibold text-content-primary mb-1">
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
                                    <label for="alamat" class="block text-sm font-semibold text-content-primary mb-1">
                                        Alamat Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="alamat"
                                              name="alamat"
                                              rows="3"
                                              required
                                              placeholder="Masukkan alamat lengkap lokasi acara atau pemasangan di Tulungagung..."
                                              class="w-full rounded-md border-surface-border focus:border-primary focus:ring-primary text-sm">{{ old('alamat') }}</textarea>
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                                </div>

                                <!-- Catatan -->
                                <div class="mb-5">
                                    <label for="catatan" class="block text-sm font-semibold text-content-primary mb-1">
                                        Catatan Tambahan <span class="text-xs text-content-secondary font-normal">(opsional)</span>
                                    </label>
                                    <textarea id="catatan"
                                              name="catatan"
                                              rows="2"
                                              placeholder="Contoh: Jam acara, detail penarikan kabel, patokan rumah, dsb."
                                              class="w-full rounded-md border-surface-border focus:border-primary focus:ring-primary text-sm">{{ old('catatan') }}</textarea>
                                    <x-input-error :messages="$errors->get('catatan')" class="mt-1" />
                                </div>

                                <!-- Kalkulasi Estimasi Total -->
                                <div class="p-4 bg-sky-50/50 rounded-md border border-surface-border mb-5">
                                    <div class="flex justify-between items-center text-xs text-content-secondary mb-1">
                                        <span>Tarif per unit:</span>
                                        <span>Rp {{ number_format($service->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-baseline pt-2 border-t border-surface-border">
                                        <span class="text-sm font-medium text-content-primary">Estimasi Total:</span>
                                        <span class="font-heading font-bold text-lg text-navy">
                                            Rp <span x-text="((jumlah > 0 ? jumlah : 1) * harga).toLocaleString('id-ID')"></span>
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-content-secondary mt-1.5">
                                        * Total resmi dihitung otomatis di server. Status awal pesanan: <span class="font-semibold text-amber-600">Pending</span>.
                                    </p>
                                </div>

                                <!-- Tombol Kirim Pesanan -->
                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold text-sm rounded-md transition">
                                    Pesan Layanan Sekarang
                                </button>
                            </form>
                        @else
                            <!-- Box untuk Tamu / User Belum Login -->
                            <div class="text-center py-6 px-4 bg-white border border-surface-border rounded-md">
                                <h3 class="font-heading font-bold text-base text-navy">
                                    Silakan Masuk untuk Memesan
                                </h3>
                                <p class="text-xs text-content-secondary mt-1.5 leading-relaxed">
                                    Masuk ke akun Anda untuk melakukan pemesanan layanan secara online.
                                </p>

                                <div class="mt-5 space-y-2">
                                    <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-5 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md transition">
                                        Masuk ke Akun
                                    </a>
                                    <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center px-5 py-2 bg-transparent text-primary-dark border border-primary text-xs font-semibold rounded-md hover:bg-sky-50 transition">
                                        Belum punya akun? Daftar
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
