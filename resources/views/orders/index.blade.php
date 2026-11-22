<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
                    Pesanan Saya
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Pantau status dan riwayat transaksi pemesanan layanan Anda di Narendra Media
                </p>
            </div>
            <div>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Pesan Layanan Lain</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($orders->isEmpty())
                <!-- Tampilan Jika Belum Ada Pesanan -->
                <div class="bg-surface-card rounded-2xl border border-surface-border p-12 text-center max-w-lg mx-auto shadow-xs">
                    <div class="w-16 h-16 rounded-full bg-sky-50 text-primary-dark mx-auto flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-navy">
                        Belum Ada Pesanan
                    </h3>
                    <p class="text-sm text-content-secondary mt-2 leading-relaxed">
                        Anda belum memiliki riwayat pemesanan layanan. Silakan jelajahi katalog layanan multimedia kami dan lakukan pemesanan online.
                    </p>
                    <div class="mt-6">
                        <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            Lihat Katalog Layanan
                        </a>
                    </div>
                </div>
            @else
                <!-- Daftar Kartu Transaksi -->
                <div class="space-y-6">
                    @foreach ($orders as $order)
                        <div class="bg-surface-card rounded-xl border border-surface-border overflow-hidden shadow-xs hover:border-primary/50 transition duration-150">
                            <!-- Bagian Header Nota Transaksi -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-6 py-4 bg-slate-50/70 border-b border-surface-border">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-navy/5 text-navy flex items-center justify-center font-bold text-xs font-mono">
                                        #
                                    </div>
                                    <div>
                                        <div class="font-heading font-bold text-base text-navy font-mono">
                                            {{ $order->nomor_pesanan ?: ('ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT)) }}
                                        </div>
                                        <div class="text-xs text-content-secondary">
                                            Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <x-status-badge :status="$order->status" />
                                </div>
                            </div>

                            <!-- Bagian Detail Transaksi (Header-Detail) -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                                    <!-- Daftar Item Layanan (Detail Transaksi) -->
                                    <div class="lg:col-span-7 space-y-3">
                                        <div class="text-xs font-semibold uppercase tracking-wider text-content-secondary mb-2">
                                            Rincian Item Layanan:
                                        </div>

                                        @forelse ($order->orderDetails as $detail)
                                            @php
                                                $serviceItem = $detail->service;
                                                $catName = $serviceItem->category->nama ?? $serviceItem->kategori ?? 'Layanan';
                                                $catBg = '#0891B2';
                                                if (str_contains($catName, 'Proyektor')) {
                                                    $catBg = '#7C3AED';
                                                } elseif (str_contains($catName, 'CCTV')) {
                                                    $catBg = '#EA580C';
                                                }
                                            @endphp
                                            <div class="p-4 rounded-xl bg-slate-50/60 border border-surface-border">
                                                <div class="flex items-start justify-between gap-3">
                                                    <div>
                                                        <div class="flex items-center gap-2 mb-1.5">
                                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded text-white uppercase tracking-wider" style="background-color: {{ $catBg }};">
                                                                {{ $serviceItem->tipe ?? 'Layanan' }}
                                                            </span>
                                                            <span class="text-xs font-medium text-slate-500">
                                                                {{ $catName }}
                                                            </span>
                                                        </div>
                                                        <h4 class="font-heading font-bold text-base text-navy">
                                                            {{ $serviceItem->nama ?? 'Layanan' }}
                                                        </h4>
                                                        <p class="text-xs text-content-secondary line-clamp-2 mt-1">
                                                            {{ $serviceItem->deskripsi ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="mt-3 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                                                    <span class="text-content-secondary">
                                                        <span class="font-semibold text-content-primary">{{ $detail->jumlah }} unit</span> &times; Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                                    </span>
                                                    <span class="font-bold text-navy text-sm">
                                                        Subtotal: Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-xs text-slate-400 italic">Data rincian layanan tidak tersedia.</div>
                                        @endforelse
                                    </div>

                                    <!-- Detail Pelaksanaan, Lokasi & Ringkasan Pembayaran -->
                                    <div class="lg:col-span-5 space-y-4">
                                        <div class="p-4 rounded-xl bg-sky-50/40 border border-surface-border space-y-3">
                                            <div>
                                                <span class="text-xs font-medium text-content-secondary block">Tanggal Pelaksanaan / Pasang:</span>
                                                <div class="font-semibold text-sm text-navy mt-0.5 flex items-center gap-1.5">
                                                    <svg class="w-4 h-4 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>{{ \Carbon\Carbon::parse($order->tanggal)->isoFormat('dddd, D MMMM Y') }}</span>
                                                </div>
                                            </div>

                                            <div class="pt-2 border-t border-surface-border">
                                                <span class="text-xs font-medium text-content-secondary block">Alamat Pemasangan:</span>
                                                <p class="text-xs text-content-primary mt-0.5 leading-relaxed">
                                                    {{ $order->alamat }}
                                                </p>
                                            </div>

                                            @if ($order->catatan)
                                                <div class="pt-2 border-t border-surface-border">
                                                    <span class="text-xs font-medium text-content-secondary block">Catatan Pesanan:</span>
                                                    <p class="text-xs text-amber-900 bg-amber-50 rounded-md p-2 mt-1 border border-amber-200 leading-relaxed italic">
                                                        "{{ $order->catatan }}"
                                                    </p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Total Transaksi -->
                                        <div class="p-4 rounded-xl bg-white border border-surface-border flex items-center justify-between">
                                            <div>
                                                <div class="text-xs text-content-secondary font-medium">Total Pembayaran</div>
                                                <div class="text-xl font-bold font-heading text-navy mt-0.5">
                                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Narendra Media, saya ingin konfirmasi pesanan dengan nomor ' . ($order->nomor_pesanan ?: ('#' . $order->id))) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow-xs transition">
                                                <span>WhatsApp Admin</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
