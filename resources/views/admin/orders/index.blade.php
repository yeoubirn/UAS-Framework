<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
                    Kelola Pesanan
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Daftar seluruh transaksi masuk dari pelanggan dan pembaruan status pemrosesan
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Summary KPI Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                <div class="bg-white p-4 sm:p-5 rounded-xl border border-surface-border shadow-xs">
                    <div class="text-xs font-medium uppercase tracking-wider text-content-secondary">Total Transaksi</div>
                    <div class="text-2xl font-bold font-heading text-navy mt-1">{{ $counts['total'] ?? 0 }}</div>
                </div>

                <div class="bg-white p-4 sm:p-5 rounded-xl border border-amber-200 bg-amber-50/30 shadow-xs">
                    <div class="text-xs font-semibold uppercase tracking-wider text-amber-700">Pending</div>
                    <div class="text-2xl font-bold font-heading text-amber-600 mt-1">{{ $counts['pending'] ?? 0 }}</div>
                </div>

                <div class="bg-white p-4 sm:p-5 rounded-xl border border-blue-200 bg-blue-50/30 shadow-xs">
                    <div class="text-xs font-semibold uppercase tracking-wider text-blue-700">Dikonfirmasi</div>
                    <div class="text-2xl font-bold font-heading text-blue-600 mt-1">{{ $counts['dikonfirmasi'] ?? 0 }}</div>
                </div>

                <div class="bg-white p-4 sm:p-5 rounded-xl border border-emerald-200 bg-emerald-50/30 shadow-xs">
                    <div class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Selesai</div>
                    <div class="text-2xl font-bold font-heading text-emerald-600 mt-1">{{ $counts['selesai'] ?? 0 }}</div>
                </div>
            </div>

            <!-- Orders Table Card -->
            <div class="bg-surface-card rounded-xl border border-surface-border shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-content-primary">
                        <thead class="bg-slate-50/80 border-b border-surface-border text-xs uppercase text-content-secondary font-semibold">
                            <tr>
                                <th scope="col" class="px-6 py-4">Nomor Pesanan</th>
                                <th scope="col" class="px-6 py-4">Pelanggan</th>
                                <th scope="col" class="px-6 py-4">Detail Layanan</th>
                                <th scope="col" class="px-6 py-4">Waktu Pasang/Pakai</th>
                                <th scope="col" class="px-6 py-4">Total Bayar</th>
                                <th scope="col" class="px-6 py-4">Status</th>
                                <th scope="col" class="px-6 py-4">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-border">
                            @forelse ($orders as $order)
                                <tr class="hover:bg-sky-50/30 transition align-top">
                                    <!-- Nomor & Tgl Order Dibuat -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-navy text-sm font-mono">
                                            {{ $order->nomor_pesanan ?: ('ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT)) }}
                                        </div>
                                        <div class="text-xs text-content-secondary mt-1">
                                            {{ $order->created_at->format('d/m/Y H:i') }} WIB
                                        </div>
                                    </td>

                                    <!-- Data Pelanggan -->
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-navy">{{ $order->user->name }}</div>
                                        <div class="text-xs text-content-secondary mt-0.5 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            <span>{{ $order->user->no_hp ?: 'No HP: -' }}</span>
                                        </div>
                                        <div class="text-xs text-slate-400">{{ $order->user->email }}</div>
                                    </td>

                                    <!-- Detail Transaksi (Master-Detail) -->
                                    <td class="px-6 py-4 min-w-[260px]">
                                        <div class="space-y-2">
                                            @forelse ($order->orderDetails as $detail)
                                                <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/70 text-xs">
                                                    <div class="font-semibold text-navy text-sm">
                                                        {{ $detail->service->nama ?? 'Layanan' }}
                                                    </div>
                                                    <div class="text-content-secondary mt-1 flex items-center justify-between">
                                                        <span>{{ $detail->jumlah }} unit &times; Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</span>
                                                        <span class="font-bold text-navy">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-xs text-slate-400 italic">Tidak ada item detail</div>
                                            @endforelse

                                            <!-- Alamat & Catatan -->
                                            @if ($order->alamat)
                                                <div class="text-xs text-content-secondary pt-1">
                                                    <span class="font-medium text-slate-700">Alamat:</span> {{ $order->alamat }}
                                                </div>
                                            @endif
                                            @if ($order->catatan)
                                                <div class="text-xs text-amber-900 bg-amber-50 rounded-md px-2 py-1 border border-amber-200">
                                                    <span class="font-semibold">Catatan:</span> {{ $order->catatan }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Waktu Pasang/Pakai -->
                                    <td class="px-6 py-4 whitespace-nowrap text-content-secondary">
                                        <div class="font-semibold text-content-primary">{{ $order->tanggal->format('d/m/Y') }}</div>
                                        <div class="text-xs text-content-secondary">{{ $order->tanggal->isoFormat('dddd') }}</div>
                                    </td>

                                    <!-- Total Transaksi -->
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-base text-navy">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-status-badge :status="$order->status" />
                                    </td>

                                    <!-- Form Ubah Status -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="text-xs rounded-lg border-surface-border py-1.5 px-2.5 focus:border-primary focus:ring-primary shadow-xs">
                                                @foreach ($statuses as $val => $label)
                                                    <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-navy hover:bg-navy-light text-white text-xs font-semibold rounded-lg shadow-xs transition">
                                                Ubah
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-content-secondary">
                                        Belum ada pesanan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($orders->hasPages())
                    <div class="p-4 border-t border-surface-border">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
