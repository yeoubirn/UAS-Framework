@props(['service'])

<div class="bg-white rounded-xl shadow-sm border border-surface-border overflow-hidden flex flex-col justify-between hover:shadow-md hover:border-blue-200 transition duration-200">
    <div>
        <!-- Gambar Layanan -->
        <div class="relative w-full h-48 bg-slate-100 overflow-hidden flex items-center justify-center">
            @if ($service->gambar && file_exists(public_path($service->gambar)))
                <img src="{{ asset($service->gambar) }}" alt="{{ $service->nama }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-blue-50 to-slate-100 flex flex-col items-center justify-center text-primary/70 p-4">
                    @if (str_contains($service->kategori, 'Proyektor'))
                        <!-- Projector Icon -->
                        <svg class="w-14 h-14 text-primary/60 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    @elseif (str_contains($service->kategori, 'CCTV'))
                        <!-- CCTV Icon -->
                        <svg class="w-14 h-14 text-primary/60 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    @elseif (str_contains($service->kategori, 'WiFi') || str_contains($service->kategori, 'Jaringan'))
                        <!-- WiFi / Network Icon -->
                        <svg class="w-14 h-14 text-primary/60 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                        </svg>
                    @else
                        <!-- Default Service Icon -->
                        <svg class="w-14 h-14 text-primary/60 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    @endif
                    <span class="text-xs font-medium text-content-secondary capitalize">{{ $service->tipe }}</span>
                </div>
            @endif

            <!-- Tipe Badge -->
            <div class="absolute top-3 right-3">
                <span class="px-2.5 py-1 text-xs font-semibold rounded-lg shadow-sm {{ $service->tipe === 'sewa' ? 'bg-purple-100 text-purple-800 border border-purple-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }} capitalize">
                    {{ $service->tipe }}
                </span>
            </div>
        </div>

        <!-- Detail Konten -->
        <div class="p-5">
            <!-- Kategori -->
            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-lg bg-blue-50 text-primary border border-blue-100 mb-2">
                {{ $service->kategori }}
            </span>

            <!-- Nama Layanan -->
            <h3 class="font-heading font-bold text-lg text-content-primary line-clamp-1">
                {{ $service->nama }}
            </h3>

            <!-- Deskripsi Singkat -->
            <p class="mt-2 text-sm text-content-secondary line-clamp-2 leading-relaxed">
                {{ $service->deskripsi }}
            </p>
        </div>
    </div>

    <!-- Bagian Harga & Tombol Aksi -->
    <div class="p-5 pt-0">
        <div class="pt-3 border-t border-surface-border flex items-baseline justify-between mb-4">
            <span class="text-xs text-content-secondary">Biaya / Harga:</span>
            <div class="text-right">
                <span class="font-heading font-bold text-lg sm:text-xl text-primary">
                    Rp {{ number_format($service->harga, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <a href="{{ route('services.show', $service) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-xl shadow-sm transition">
            Lihat Detail
        </a>
    </div>
</div>
