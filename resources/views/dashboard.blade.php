<x-app-layout>
    <x-slot name="header">
        <h2 class="font-heading font-semibold text-xl text-content-primary leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-surface-border">
                <div class="p-6 text-content-primary">
                    <p class="font-medium text-lg">Halo, {{ Auth::user()->name }}!</p>
                    <p class="text-sm text-content-secondary mt-1">
                        Anda berhasil masuk sebagai <span class="font-semibold text-primary capitalize">{{ Auth::user()->role }}</span> di Narendra Media.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
