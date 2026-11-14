<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-bold text-2xl text-navy leading-[1.3]">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-surface-card overflow-hidden rounded-lg border border-surface-border p-6 text-content-primary">
                <p class="font-heading font-semibold text-lg text-navy leading-[1.3]">Halo, {{ Auth::user()->name }}!</p>
                <p class="text-sm text-content-secondary mt-1">
                    Anda berhasil masuk sebagai <span class="font-semibold text-primary-dark capitalize">{{ Auth::user()->role }}</span> di Narendra Media.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
