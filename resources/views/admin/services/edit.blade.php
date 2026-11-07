<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-2xl text-content-primary leading-tight">
                    Edit Layanan: {{ $service->nama }}
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Perbarui informasi layanan yang sudah ada
                </p>
            </div>
            <a href="{{ route('admin.services.index') }}" class="text-sm font-medium text-content-secondary hover:text-content-primary">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-surface-border p-6 sm:p-8">
                <form action="{{ route('admin.services.update', $service) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Layanan -->
                    <div class="mb-5">
                        <x-input-label for="nama" value="Nama Layanan" />
                        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $service->nama)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                    </div>

                    <!-- Kategori Layanan -->
                    <div class="mb-5">
                        <x-input-label for="kategori" value="Kategori Layanan" />
                        <select id="kategori" name="kategori" class="mt-1 block w-full border-surface-border rounded-lg shadow-sm focus:border-primary focus:ring-primary text-sm text-content-primary" required>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ old('kategori', $service->kategori) === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                    </div>

                    <!-- Tipe Layanan -->
                    <div class="mb-5">
                        <x-input-label for="tipe" value="Tipe Layanan" />
                        <select id="tipe" name="tipe" class="mt-1 block w-full border-surface-border rounded-lg shadow-sm focus:border-primary focus:ring-primary text-sm text-content-primary" required>
                            <option value="sewa" {{ old('tipe', $service->tipe) === 'sewa' ? 'selected' : '' }}>Sewa (Rental)</option>
                            <option value="jasa" {{ old('tipe', $service->tipe) === 'jasa' ? 'selected' : '' }}>Jasa (Instalasi / Teknisi)</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('tipe')" />
                    </div>

                    <!-- Harga -->
                    <div class="mb-5">
                        <x-input-label for="harga" value="Harga (Rp)" />
                        <x-text-input id="harga" name="harga" type="number" min="0" step="1" class="mt-1 block w-full" :value="old('harga', (int)$service->harga)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('harga')" />
                    </div>

                    <!-- Gambar (Path teks) -->
                    <div class="mb-5">
                        <x-input-label for="gambar" value="Path Gambar (Opsional)" />
                        <x-text-input id="gambar" name="gambar" type="text" class="mt-1 block w-full" :value="old('gambar', $service->gambar)" placeholder="Contoh: images/proyektor-besar.png" />
                        <p class="text-xs text-content-secondary mt-1">Path gambar teks relatif terhadap direktori public/images.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('gambar')" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <x-input-label for="deskripsi" value="Deskripsi Lengkap" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full border-surface-border rounded-lg shadow-sm focus:border-primary focus:ring-primary text-sm text-content-primary" required>{{ old('deskripsi', $service->deskripsi) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-surface-border">
                        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 border border-surface-border rounded-lg text-sm font-medium text-content-secondary hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <x-primary-button>
                            Perbarui Layanan
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
