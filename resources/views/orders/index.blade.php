<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-2xl text-content-primary leading-tight">
                    Pesanan Saya
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Pantau status dan riwayat pemesanan layanan Anda di Narendra Media
                </p>
            </div>
            <div>
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-xl shadow-sm transition">
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
            <!-- Flash Notification -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if ($orders->isEmpty())
                <!-- Tampilan Jika Belum Ada Pesanan -->
                <div class="bg-white rounded-xl border border-surface-border p-12 text-center max-w-xl mx-auto shadow-sm">
                    <div class="w-16 h-16 rounded-full bg-blue-50 text-primary flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-lg text-content-primary">
                        Belum Ada Pesanan
                    </h3>
                    <p class="text-sm text-content-secondary mt-1.5 leading-relaxed">
                        Anda belum memiliki riwayat pemesanan layanan. Silakan pilih layanan yang Anda butuhkan di katalog kami.
                    </p>
                    <div class="mt-6">
                        <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-xl shadow-sm transition">
                            Lihat Katalog Layanan
                        </a>
                    </div>
                </div>
            @else
                <!-- Daftar Kartu Pesanan -->
                <div class="space-y-4">
                    @foreach ($orders as $order)
                        <div class="bg-white rounded-xl border border-surface-border shadow-sm p-6 hover:border-blue-200 transition">
                            <!-- Bagian Header Pesanan -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-4 border-b border-surface-border">
                                <div class="flex items-center gap-3">
                                    <span class="font-heading font-bold text-base text-content-primary">
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
                                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-md bg-blue-50 text-primary border border-blue-100">
                                            {{ $order->service->kategori }}
                                        </span>
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-md capitalize {{ $order->service->tipe === 'sewa' ? 'bg-purple-50 text-purple-700' : 'bg-emerald-50 text-emerald-700' }}">
                                            {{ $order->service->tipe }}
                                        </span>
                                    </div>
                                    <h4 class="font-heading font-bold text-lg text-content-primary">
                                        {{ $order->service->nama }}
                                    </h4>
                                    <p class="text-xs text-content-secondary line-clamp-2">
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
                                        <span class="font-heading font-bold text-primary text-base">
                                            Rp {{ number_format($order->total, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Info Alamat & Catatan -->
                                <div class="md:col-span-4 space-y-2 text-sm border-t md:border-t-0 md:border-l border-surface-border pt-4 md:pt-0 md:pl-6 bg-slate-50/50 p-3 rounded-lg">
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
