<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
                    Pesanan Saya
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Pantau status dan riwayat pemesanan layanan Anda di Narendra Media
                </p>
            </div>
            <div>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md transition">
                    <span>Pesan Layanan Lain</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Notification -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-md bg-white border-l-4 border-[#16A34A] border-y border-r border-surface-border text-content-primary text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-[#16A34A] font-bold">✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if ($orders->isEmpty())
                <!-- Tampilan Jika Belum Ada Pesanan -->
                <div class="bg-surface-card rounded-lg border border-surface-border p-12 text-center max-w-xl mx-auto">
                    <h3 class="font-heading font-bold text-lg text-navy">
                        Belum Ada Pesanan
                    </h3>
                    <p class="text-sm text-content-secondary mt-1.5 leading-relaxed">
                        Anda belum memiliki riwayat pemesanan layanan. Silakan pilih layanan yang Anda butuhkan di katalog kami.
                    </p>
                    <div class="mt-6">
                        <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md transition">
                            Lihat Katalog Layanan
                        </a>
                    </div>
                </div>
            @else
                <!-- Daftar Kartu Pesanan -->
                <div class="space-y-4">
                    @foreach ($orders as $order)
                        @php
                            $catBg = '#0891B2';
                            if (str_contains($order->service->kategori, 'Proyektor')) {
                                $catBg = '#7C3AED';
                            } elseif (str_contains($order->service->kategori, 'CCTV')) {
                                $catBg = '#EA580C';
                            }
                        @endphp
                        <div class="bg-surface-card rounded-lg border border-surface-border p-6 hover:shadow-sm transition">
                            <!-- Bagian Header Pesanan -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-4 border-b border-surface-border">
                                <div class="flex items-center gap-3">
                                    <span class="font-heading font-bold text-base text-navy">
                                        Pesanan #{{ $order->id }}
                                    </span>
                                    <span class="text-xs text-content-secondary">
                                        {{ $order->created_at->format('d M Y, H:i') }} WIB
                                    </span>
                                </div>
                                <div>
                                    <x-status-badge :status="$order->status" />
                                </div>
                            </div>

                            <!-- Bagian Detail Pesanan -->
                            <div class="pt-4 grid grid-cols-1 md:grid-cols-12 gap-6">
                                <!-- Info Layanan -->
                                <div class="md:col-span-5 space-y-2">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 text-[11px] font-bold rounded-md text-white uppercase tracking-wider" style="background-color: {{ $catBg }};">
                                            {{ $order->service->tipe }}
                                        </span>
                                        <span class="text-xs font-medium text-content-secondary">
                                            {{ $order->service->kategori }}
                                        </span>
                                    </div>
                                    <h4 class="font-heading font-bold text-lg text-navy leading-[1.3]">
                                        {{ $order->service->nama }}
                                    </h4>
                                    <p class="text-xs text-content-secondary line-clamp-2 leading-relaxed">
                                        {{ $order->service->deskripsi }}
                                    </p>
                                </div>

                                <!-- Ringkasan Tanggal, Jumlah, & Total -->
                                <div class="md:col-span-3 space-y-2 text-sm border-t md:border-t-0 md:border-l border-surface-border pt-4 md:pt-0 md:pl-6">
                                    <div>
                                        <span class="text-xs text-content-secondary block">Tanggal Pelaksanaan:</span>
                                        <span class="font-semibold text-content-primary">
                                            {{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-xs text-content-secondary block">Jumlah Unit:</span>
                                        <span class="font-semibold text-content-primary">
                                            {{ $order->jumlah }} unit / titik
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-xs text-content-secondary block">Total Biaya:</span>
                                        <span class="font-heading font-bold text-navy text-base">
                                            Rp {{ number_format($order->total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Info Alamat & Catatan -->
                                <div class="md:col-span-4 space-y-2 text-sm border-t md:border-t-0 md:border-l border-surface-border pt-4 md:pt-0 md:pl-6 bg-sky-50/40 p-3 rounded-md">
                                    <div>
                                        <span class="text-xs font-semibold text-content-secondary block">Alamat Pemasangan/Acara:</span>
                                        <p class="text-content-primary text-xs mt-0.5 leading-relaxed">
                                            {{ $order->alamat }}
                                        </p>
                                    </div>
                                    @if ($order->catatan)
                                        <div class="pt-2 border-t border-surface-border/60">
                                            <span class="text-xs font-semibold text-content-secondary block">Catatan:</span>
                                            <p class="text-content-primary text-xs italic mt-0.5">
                                                "{{ $order->catatan }}"
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
