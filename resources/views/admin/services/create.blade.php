<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
                    Tambah Layanan Baru
                </h2>
                <p class="text-sm text-content-secondary mt-1">
                    Tambahkan data layanan jasa atau rental multimedia ke dalam sistem
                </p>
            </div>
            <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-content-secondary hover:text-navy transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-surface-card rounded-xl border border-surface-border shadow-xs p-6 sm:p-8">
                <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama Layanan -->
                    <div>
                        <x-input-label for="nama" value="Nama Layanan" class="font-semibold text-navy" />
                        <x-text-input id="nama" name="nama" type="text" class="mt-1.5 block w-full rounded-lg" :value="old('nama')" required autofocus placeholder="Contoh: Rental Proyektor Besar 4x3" />
                        <x-input-error class="mt-1.5" :messages="$errors->get('nama')" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Kategori Layanan (Tabel Categories) -->
                        <div>
                            <x-input-label for="category_id" value="Kategori Layanan" class="font-semibold text-navy" />
                            <select id="category_id" name="category_id" class="mt-1.5 block w-full border-surface-border rounded-lg shadow-xs focus:border-primary focus:ring-primary text-sm text-content-primary" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-1.5" :messages="$errors->get('category_id')" />
                        </div>

                        <!-- Tipe Layanan -->
                        <div>
                            <x-input-label for="tipe" value="Tipe Layanan" class="font-semibold text-navy" />
                            <select id="tipe" name="tipe" class="mt-1.5 block w-full border-surface-border rounded-lg shadow-xs focus:border-primary focus:ring-primary text-sm text-content-primary" required>
                                <option value="sewa" {{ old('tipe') === 'sewa' ? 'selected' : '' }}>Sewa (Rental)</option>
                                <option value="jasa" {{ old('tipe') === 'jasa' ? 'selected' : '' }}>Jasa (Instalasi / Setting)</option>
                            </select>
                            <x-input-error class="mt-1.5" :messages="$errors->get('tipe')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Harga -->
                        <div>
                            <x-input-label for="harga" value="Harga (Rp)" class="font-semibold text-navy" />
                            <x-text-input id="harga" name="harga" type="number" min="0" step="1" class="mt-1.5 block w-full rounded-lg" :value="old('harga')" required placeholder="Contoh: 450000" />
                            <x-input-error class="mt-1.5" :messages="$errors->get('harga')" />
                        </div>

                        <!-- Gambar (Path teks) -->
                        <div>
                            <x-input-label for="gambar" value="Path Gambar (Opsional)" class="font-semibold text-navy" />
                            <x-text-input id="gambar" name="gambar" type="text" class="mt-1.5 block w-full rounded-lg" :value="old('gambar')" placeholder="Contoh: images/proyektor.png" />
                            <p class="text-xs text-content-secondary mt-1">Opsional, path teks relatif direktori public/images.</p>
                            <x-input-error class="mt-1.5" :messages="$errors->get('gambar')" />
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi Layanan" class="font-semibold text-navy" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1.5 block w-full border-surface-border rounded-lg shadow-xs focus:border-primary focus:ring-primary text-sm text-content-primary" required placeholder="Jelaskan spesifikasi, cakupan layanan, atau kelengkapan alat...">{{ old('deskripsi') }}</textarea>
                        <x-input-error class="mt-1.5" :messages="$errors->get('deskripsi')" />
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-surface-border">
                        <a href="{{ route('admin.services.index') }}" class="px-4 py-2.5 text-sm font-semibold text-content-secondary hover:text-navy transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            Simpan Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
