<x-app-layout>
    <div class="py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-medium text-content-secondary hover:text-primary transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Katalog Layanan</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Kolom Kiri: Detail Layanan -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-surface-border overflow-hidden">
                        <!-- Gambar / Ilustrasi Layanan -->
                        <div class="relative w-full h-64 sm:h-80 bg-slate-100 overflow-hidden flex items-center justify-center">
                            @if ($service->gambar && file_exists(public_path($service->gambar)))
                                <img src="{{ asset($service->gambar) }}" alt="{{ $service->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-50 to-slate-100 flex flex-col items-center justify-center text-primary/70 p-6">
                                    @if (str_contains($service->kategori, 'Proyektor'))
                                        <svg class="w-20 h-20 text-primary/60 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    @elseif (str_contains($service->kategori, 'CCTV'))
                                        <svg class="w-20 h-20 text-primary/60 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    @elseif (str_contains($service->kategori, 'WiFi') || str_contains($service->kategori, 'Jaringan'))
                                        <svg class="w-20 h-20 text-primary/60 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                                        </svg>
                                    @else
                                        <svg class="w-20 h-20 text-primary/60 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @endif
                                    <span class="text-sm font-medium text-content-secondary capitalize">Layanan {{ $service->tipe }}</span>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1.5 text-xs font-semibold rounded-lg shadow-sm {{ $service->tipe === 'sewa' ? 'bg-purple-100 text-purple-800 border border-purple-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }} capitalize">
                                    {{ $service->tipe }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-lg bg-blue-50 text-primary border border-blue-100">
                                    {{ $service->kategori }}
                                </span>
                            </div>

                            <h1 class="font-heading font-bold text-2xl sm:text-3xl text-content-primary">
                                {{ $service->nama }}
                            </h1>

                            <div class="mt-4 pb-6 border-b border-surface-border">
                                <span class="text-xs text-content-secondary uppercase tracking-wider font-semibold">Harga Satuan / Tarif Layanan:</span>
                                <div class="font-heading font-bold text-2xl sm:text-3xl text-primary mt-1">
                                    Rp {{ number_format($service->harga, 0, ',', '.') }}
                                    <span class="text-sm font-normal text-content-secondary capitalize">/ {{ $service->tipe }}</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h2 class="font-heading font-semibold text-lg text-content-primary mb-2">
                                    Deskripsi Layanan
                                </h2>
                                <p class="text-content-secondary text-base leading-relaxed whitespace-pre-line">
                                    {{ $service->deskripsi }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Usaha Narendra Media -->
                    <div class="bg-blue-50/60 border border-blue-100 rounded-xl p-6">
                        <h3 class="font-heading font-semibold text-base text-content-primary mb-3">
                            Tentang Layanan Narendra Media
                        </h3>
                        <ul class="space-y-2 text-sm text-content-secondary">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-primary shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Operasional 24 Jam siap membantu kebutuhan Anda</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-primary shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Wilayah layanan: Tulungagung dan sekitarnya</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-primary shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Konsultasi & Kontak: ekowawan818@gmail.com</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Pemesanan -->
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-xl shadow-sm border border-surface-border p-6 sm:p-7 sticky top-24">
                        <div class="border-b border-surface-border pb-4 mb-5">
                            <h2 class="font-heading font-bold text-xl text-content-primary">
                                Form Pemesanan
                            </h2>
                            <p class="text-xs text-content-secondary mt-1">
                                Satu pesanan untuk satu layanan. Total biaya akan dihitung otomatis oleh sistem.
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
                                           class="w-full rounded-xl border-surface-border focus:border-primary focus:ring focus:ring-primary/20 text-sm">
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
                                           class="w-full rounded-xl border-surface-border focus:border-primary focus:ring focus:ring-primary/20 text-sm">
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
                                              class="w-full rounded-xl border-surface-border focus:border-primary focus:ring focus:ring-primary/20 text-sm">{{ old('alamat') }}</textarea>
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
                                              class="w-full rounded-xl border-surface-border focus:border-primary focus:ring focus:ring-primary/20 text-sm">{{ old('catatan') }}</textarea>
                                    <x-input-error :messages="$errors->get('catatan')" class="mt-1" />
                                </div>

                                <!-- Kalkulasi Estimasi Total -->
                                <div class="p-4 bg-gray-50 rounded-xl border border-surface-border mb-5">
                                    <div class="flex justify-between items-center text-xs text-content-secondary mb-1">
                                        <span>Tarif per unit:</span>
                                        <span>Rp {{ number_format($service->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-baseline pt-2 border-t border-surface-border">
                                        <span class="text-sm font-medium text-content-primary">Estimasi Total:</span>
                                        <span class="font-heading font-bold text-lg text-primary">
                                            Rp <span x-text="((jumlah > 0 ? jumlah : 1) * harga).toLocaleString('id-ID')"></span>
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-content-secondary mt-1.5">
                                        * Total resmi dihitung otomatis di server saat pesanan dibuat. Status awal pesanan: <span class="font-semibold text-amber-600">Pending</span>.
                                    </p>
                                </div>

                                <!-- Tombol Kirim Pesanan -->
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-accent hover:bg-accent-hover text-white font-semibold rounded-xl shadow-sm transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <span>Pesan Layanan Sekarang</span>
                                </button>
                            </form>
                        @else
                            <!-- Box untuk Tamu / User Belum Login -->
                            <div class="text-center py-6 px-4 bg-amber-50/70 border border-amber-200 rounded-xl">
                                <div class="w-12 h-12 rounded-full bg-amber-100 text-accent flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <h3 class="font-heading font-bold text-base text-content-primary">
                                    Silakan Masuk untuk Memesan
                                </h3>
                                <p class="text-xs text-content-secondary mt-1.5 leading-relaxed">
                                    Hanya user yang sudah login yang dapat memesan layanan Narendra Media secara online.
                                </p>

                                <div class="mt-5 space-y-2">
                                    <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-5 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-xl shadow-sm transition">
                                        Masuk ke Akun
                                    </a>
                                    <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center px-5 py-2 bg-white hover:bg-gray-50 text-content-primary border border-surface-border text-xs font-medium rounded-xl transition">
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
