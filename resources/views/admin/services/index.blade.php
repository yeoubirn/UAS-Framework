<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
                    Kelola Layanan
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Daftar layanan jasa dan rental multimedia Narendra Media
                </p>
            </div>
            <div>
                <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Stat Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="bg-white p-5 rounded-xl border border-surface-border shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-xs font-medium uppercase tracking-wider text-content-secondary">Total Layanan</div>
                        <div class="text-2xl font-bold font-heading text-navy mt-1">{{ $totalServices ?? $services->total() }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-sky-50 text-primary-dark flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-surface-border shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-xs font-medium uppercase tracking-wider text-content-secondary">Kategori Aktif</div>
                        <div class="text-2xl font-bold font-heading text-navy mt-1">{{ $totalCategories ?? 3 }}</div>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl border border-surface-border shadow-xs flex items-center justify-between sm:col-span-2 lg:col-span-1">
                    <div>
                        <div class="text-xs font-medium uppercase tracking-wider text-content-secondary">Navigasi Cepat</div>
                        <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-primary-dark hover:underline mt-1 inline-flex items-center gap-1">
                            <span>Buka Kelola Pesanan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Services Table Card -->
            <div class="bg-surface-card rounded-xl border border-surface-border shadow-xs overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-content-primary">
                        <thead class="bg-slate-50/80 border-b border-surface-border text-xs uppercase text-content-secondary font-semibold">
                            <tr>
                                <th scope="col" class="px-6 py-4">Layanan</th>
                                <th scope="col" class="px-6 py-4">Kategori</th>
                                <th scope="col" class="px-6 py-4">Tipe</th>
                                <th scope="col" class="px-6 py-4">Harga Satuan</th>
                                <th scope="col" class="px-6 py-4">Gambar</th>
                                <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-border">
                            @forelse ($services as $service)
                                @php
                                    $catName = $service->category->nama ?? $service->kategori;
                                    $catBg = '#0891B2';
                                    if (str_contains($catName, 'Proyektor')) {
                                        $catBg = '#7C3AED';
                                    } elseif (str_contains($catName, 'CCTV')) {
                                        $catBg = '#EA580C';
                                    }
                                @endphp
                                <tr class="hover:bg-sky-50/30 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-navy">{{ $service->nama }}</div>
                                        <div class="text-xs text-content-secondary mt-0.5 line-clamp-1 max-w-sm">{{ $service->deskripsi }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium text-slate-700 bg-slate-100 border border-slate-200">
                                            {{ $catName }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-2.5 py-0.5 text-[11px] font-bold rounded text-white uppercase tracking-wider" style="background-color: {{ $catBg }};">
                                            {{ $service->tipe }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-navy">
                                        Rp {{ number_format($service->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-content-secondary">
                                        {{ $service->gambar ?: '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="inline-flex items-center px-3 py-1.5 border border-primary text-primary-dark hover:bg-primary hover:text-white text-xs font-semibold rounded-lg transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-semibold rounded-lg transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-content-secondary">
                                        Belum ada layanan yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($services->hasPages())
                    <div class="p-4 border-t border-surface-border">
                        {{ $services->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
