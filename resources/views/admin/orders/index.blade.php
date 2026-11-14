<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
                    Kelola Pesanan
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Daftar seluruh pesanan masuk dari pelanggan dan pembaruan status
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Message -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-md bg-white border-l-4 border-[#16A34A] border-y border-r border-surface-border text-content-primary text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-[#16A34A] font-bold">✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Orders Table Card -->
            <div class="bg-surface-card rounded-lg border border-surface-border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-content-primary">
                        <thead class="bg-sky-50/50 border-b border-surface-border text-xs uppercase text-content-secondary font-semibold">
                            <tr>
                                <th scope="col" class="px-6 py-3.5">ID</th>
                                <th scope="col" class="px-6 py-3.5">Pelanggan</th>
                                <th scope="col" class="px-6 py-3.5">Layanan</th>
                                <th scope="col" class="px-6 py-3.5">Tanggal Pakai</th>
                                <th scope="col" class="px-6 py-3.5">Total</th>
                                <th scope="col" class="px-6 py-3.5">Status Saat Ini</th>
                                <th scope="col" class="px-6 py-3.5">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-border">
                            @forelse ($orders as $order)
                                <tr class="hover:bg-sky-50/30 transition">
                                    <td class="px-6 py-4 font-semibold text-content-secondary whitespace-nowrap">
                                        #{{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-navy">{{ $order->user->name }}</div>
                                        <div class="text-xs text-content-secondary mt-0.5">{{ $order->user->no_hp ?: 'No HP: -' }}</div>
                                        <div class="text-xs text-slate-400">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-content-primary">{{ $order->service->nama }}</div>
                                        <div class="text-xs text-content-secondary mt-0.5">
                                            Jumlah: <span class="font-medium text-content-primary">{{ $order->jumlah }} unit</span>
                                        </div>
                                        @if ($order->alamat)
                                            <div class="text-xs text-content-secondary mt-1 line-clamp-1" title="{{ $order->alamat }}">
                                                <span class="font-medium">Alamat:</span> {{ $order->alamat }}
                                            </div>
                                        @endif
                                        @if ($order->catatan)
                                            <div class="text-xs text-amber-800 bg-amber-50 rounded px-1.5 py-0.5 mt-1 inline-block border border-amber-200">
                                                Catatan: {{ $order->catatan }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-content-secondary">
                                        <div class="font-medium text-content-primary">{{ $order->tanggal->format('d/m/Y') }}</div>
                                        <div class="text-xs text-content-secondary">{{ $order->tanggal->isoFormat('dddd') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-navy">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-status-badge :status="$order->status" />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="text-xs py-1.5 px-2.5 border-surface-border rounded-md shadow-sm focus:ring-primary focus:border-primary text-content-primary bg-white">
                                                @foreach ($statuses as $val => $label)
                                                    <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="text-xs px-3 py-1.5 bg-primary-dark hover:bg-navy text-white font-medium rounded-md shadow-sm transition">
                                                Simpan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-content-secondary">
                                        Belum ada pesanan yang masuk.
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
