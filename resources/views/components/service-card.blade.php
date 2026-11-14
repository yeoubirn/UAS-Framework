@props(['service'])

@php
    $catColor = '#0891B2';
    $catBgClass = 'bg-[#0891B2]';
    if (str_contains($service->kategori, 'Proyektor')) {
        $catColor = '#7C3AED';
        $catBgClass = 'bg-[#7C3AED]';
    } elseif (str_contains($service->kategori, 'CCTV')) {
        $catColor = '#EA580C';
        $catBgClass = 'bg-[#EA580C]';
    }
@endphp

<div class="bg-surface-card rounded-lg border border-surface-border overflow-hidden flex flex-col justify-between hover:shadow-sm transition duration-150">
    <div>
        <!-- Gambar Layanan / Placeholder Berwarna Solid Sesuai Kategori -->
        <div class="relative w-full h-44 overflow-hidden flex items-center justify-center">
            @if ($service->gambar && file_exists(public_path($service->gambar)))
                <img src="{{ asset($service->gambar) }}" alt="{{ $service->nama }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full {{ $catBgClass }} flex items-center justify-center p-4 text-center">
                    <span class="font-heading font-semibold text-white text-base tracking-wide">
                        {{ $service->kategori }}
                    </span>
                </div>
            @endif

            <!-- Label Tipe: Kotak kecil rounded-md, latar solid warna kategori, teks putih, huruf kapital kecil tracking lebar -->
            <div class="absolute top-3 right-3">
                <span class="px-2 py-0.5 text-[11px] font-bold rounded-md {{ $catBgClass }} text-white uppercase tracking-wider">
                    {{ $service->tipe }}
                </span>
            </div>
        </div>

        <!-- Detail Konten -->
        <div class="p-5">
            <!-- Nama Layanan -->
            <h3 class="font-heading font-bold text-lg text-navy leading-[1.3] line-clamp-1">
                {{ $service->nama }}
            </h3>

            <!-- Deskripsi Singkat -->
            <p class="mt-2 text-sm text-content-secondary line-clamp-2 leading-relaxed">
                {{ $service->deskripsi }}
            </p>
        </div>
    </div>

    <!-- Bagian Harga & Tombol Aksi Penuh -->
    <div class="p-5 pt-0">
        <div class="pt-3 border-t border-surface-border flex items-baseline justify-between mb-4">
            <span class="text-xs text-content-secondary">Biaya:</span>
            <div class="text-right">
                <span class="font-heading font-bold text-xl text-navy">
                    Rp {{ number_format($service->harga, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <a href="{{ route('services.show', $service) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md transition shadow-none">
            Lihat Detail
        </a>
    </div>
</div>
