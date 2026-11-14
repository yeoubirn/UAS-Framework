<x-app-layout>
    <x-slot name="header">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">
            <h2 class="font-heading font-semibold text-xl sm:text-2xl text-navy leading-[1.3]">
                {{ __('Profil saya') }}
            </h2>
            <p class="text-sm text-content-secondary mt-1">
                Kelola informasi akun dan pengaturan keamanan kata sandi Anda
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-6">
            <!-- Kotak Informasi Profil -->
            <div class="p-6 sm:p-8 bg-surface-card border border-surface-border rounded-lg shadow-sm">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Kotak Perbarui Kata Sandi -->
            <div class="p-6 sm:p-8 bg-surface-card border border-surface-border rounded-lg shadow-sm">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Tombol Hapus Akun (tanpa kotak pembungkus putih/border) -->
            <div class="pt-2">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
