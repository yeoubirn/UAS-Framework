@props(['service'])

@php
    $categoryName = $service->category->nama ?? $service->kategori ?? 'Umum';
    $catBgClass = 'bg-[#0891B2]';
    $catIcon = '📶';
    if (str_contains($categoryName, 'Proyektor')) {
        $catBgClass = 'bg-[#7C3AED]';
        $catIcon = '📽️';
    } elseif (str_contains($categoryName, 'CCTV')) {
        $catBgClass = 'bg-[#EA580C]';
        $catIcon = '📹';
    }
@endphp

<div class="bg-surface-card rounded-lg border border-surface-border overflow-hidden flex flex-col justify-between hover:shadow-md hover:-translate-y-0.5 transition duration-200 group">
    <div>
        <!-- Gambar Layanan / Placeholder Berwarna Solid Sesuai Kategori (Sesuai Aturan BRIEF.md) -->
        <div class="relative w-full h-48 overflow-hidden flex items-center justify-center">
            @if ($service->gambar && file_exists(public_path($service->gambar)))
                <img src="{{ asset($service->gambar) }}" alt="{{ $service->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            @else
                <div class="w-full h-full {{ $catBgClass }} flex flex-col items-center justify-center p-6 text-center relative overflow-hidden select-none">
                    <!-- Subtle Watermark Icon Background -->
                    <span class="absolute -right-3 -bottom-3 text-7xl opacity-20 pointer-events-none transform -rotate-12">{{ $catIcon }}</span>
                    
                    <span class="font-heading font-bold text-white text-lg tracking-wide drop-shadow-xs relative z-10">
                        {{ $categoryName }}
                    </span>
                    <span class="text-[11px] text-white/85 font-medium mt-1 relative z-10">Narendra Media Tulungagung</span>
                </div>
            @endif

            <!-- Label Tipe ("Sewa" / "Jasa"): Kotak kecil (rounded-md), latar solid warna kategori, teks putih, huruf kapital kecil tracking lebar -->
            <div class="absolute top-3.5 right-3.5 shadow-sm">
                <span class="px-2.5 py-1 text-[11px] font-bold rounded-md {{ $catBgClass }} text-white uppercase tracking-wider inline-block">
                    {{ $service->tipe }}
                </span>
            </div>
        </div>

        <!-- Detail Konten -->
        <div class="p-5 sm:p-6">
            <!-- Kategori Kecil -->
            <div class="text-[11px] font-semibold text-content-secondary uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full {{ $catBgClass }}"></span>
                <span>{{ $categoryName }}</span>
            </div>

            <!-- Nama Layanan -->
            <h3 class="font-heading font-bold text-base sm:text-lg text-navy leading-[1.3] line-clamp-1 group-hover:text-primary-dark transition-colors">
                {{ $service->nama }}
            </h3>

            <!-- Deskripsi Singkat -->
            <p class="mt-2 text-xs sm:text-sm text-content-secondary line-clamp-2 leading-relaxed">
                {{ $service->deskripsi }}
            </p>
        </div>
    </div>

    <!-- Bagian Harga & Tombol Aksi Penuh -->
    <div class="p-5 sm:p-6 pt-0">
        <div class="pt-3.5 border-t border-surface-border flex items-baseline justify-between mb-4">
            <span class="text-xs text-content-secondary font-medium">Biaya:</span>
            <div class="text-right">
                <span class="font-heading font-bold text-lg sm:text-xl text-navy">
                    Rp {{ number_format($service->harga, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Tombol "Lihat Detail" ukuran penuh di bawah kartu (Sesuai Aturan BRIEF.md) -->
        <a href="{{ route('services.show', $service) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md transition shadow-xs group-hover:shadow-sm">
            <span>Lihat Detail</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>
</div>
