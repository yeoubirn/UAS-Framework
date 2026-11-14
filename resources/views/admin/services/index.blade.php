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
                <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-md transition">
                    <span>Tambah Layanan</span>
                </a>
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

            <!-- Services Table Card -->
            <div class="bg-surface-card rounded-lg border border-surface-border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-content-primary">
                        <thead class="bg-sky-50/50 border-b border-surface-border text-xs uppercase text-content-secondary font-semibold">
                            <tr>
                                <th scope="col" class="px-6 py-3.5">Layanan</th>
                                <th scope="col" class="px-6 py-3.5">Kategori</th>
                                <th scope="col" class="px-6 py-3.5">Tipe</th>
                                <th scope="col" class="px-6 py-3.5">Harga</th>
                                <th scope="col" class="px-6 py-3.5">Gambar</th>
                                <th scope="col" class="px-6 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-border">
                            @forelse ($services as $service)
                                @php
                                    $catBg = '#0891B2';
                                    if (str_contains($service->kategori, 'Proyektor')) {
                                        $catBg = '#7C3AED';
                                    } elseif (str_contains($service->kategori, 'CCTV')) {
                                        $catBg = '#EA580C';
                                    }
                                @endphp
                                <tr class="hover:bg-sky-50/30 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-navy">{{ $service->nama }}</div>
                                        <div class="text-xs text-content-secondary mt-0.5 line-clamp-1 max-w-xs">{{ $service->deskripsi }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-content-secondary">
                                        {{ $service->kategori }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-2 py-0.5 text-[11px] font-bold rounded-md text-white uppercase tracking-wider" style="background-color: {{ $catBg }};">
                                            {{ $service->tipe }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-navy">
                                        Rp {{ number_format($service->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-content-secondary">
                                        {{ $service->gambar ?: '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="inline-flex items-center px-3 py-1.5 border border-primary text-primary-dark hover:bg-primary hover:text-white text-xs font-semibold rounded-md transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-md transition">
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
