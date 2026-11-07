<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-2xl text-content-primary leading-tight">
                    Kelola Layanan
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Daftar layanan jasa dan rental multimedia Narendra Media
                </p>
            </div>
            <div>
                <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Flash Message -->
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

            <!-- Services Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-surface-border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-content-primary">
                        <thead class="bg-gray-50 border-b border-surface-border text-xs uppercase text-content-secondary font-semibold">
                            <tr>
                                <th scope="col" class="px-6 py-4">Layanan</th>
                                <th scope="col" class="px-6 py-4">Kategori</th>
                                <th scope="col" class="px-6 py-4">Tipe</th>
                                <th scope="col" class="px-6 py-4">Harga</th>
                                <th scope="col" class="px-6 py-4">Gambar</th>
                                <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-border">
                            @forelse ($services as $service)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-content-primary">{{ $service->nama }}</div>
                                        <div class="text-xs text-content-secondary mt-0.5 line-clamp-1 max-w-xs">{{ $service->deskripsi }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-lg bg-blue-50 text-primary border border-blue-100">
                                            {{ $service->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">
                                        <span class="inline-block px-2 py-0.5 text-xs font-medium rounded-md {{ $service->tipe === 'sewa' ? 'bg-purple-50 text-purple-700' : 'bg-emerald-50 text-emerald-700' }}">
                                            {{ $service->tipe }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-content-primary">
                                        Rp {{ number_format($service->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-content-secondary">
                                        {{ $service->gambar ?: '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-content-primary text-xs font-medium rounded-lg transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-medium rounded-lg transition">
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
