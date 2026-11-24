<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Narendra Media') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-navy text-content-primary relative overflow-x-hidden min-h-screen flex flex-col justify-center">
        <!-- Ambient Glow Effects (Sama Seperti Hero, Tanpa Kotak-Kotak Grid Kaku) -->
        <div class="fixed -top-32 -right-32 w-96 h-96 rounded-full bg-cyan-500/20 blur-3xl pointer-events-none"></div>
        <div class="fixed -bottom-32 -left-32 w-80 h-80 rounded-full bg-orange-500/15 blur-3xl pointer-events-none"></div>
        <div class="fixed top-1/2 left-1/3 w-72 h-72 rounded-full bg-indigo-500/15 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center gap-2 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Narendra Media" class="h-14 w-auto object-contain bg-white/10 rounded-xl p-2 backdrop-blur-md border border-white/20 group-hover:scale-105 transition">
                    <span class="font-heading font-bold text-2xl text-white">Narendra Media</span>
                </a>
            </div>

            <!-- Card Form Login & Register: Rounded Lembut, Tanpa Kotak Kaku -->
            <div class="w-full sm:max-w-md bg-white border border-surface-border rounded-2xl shadow-xl p-7 sm:p-8">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} Narendra Media. Layanan Multimedia & Jaringan Tulungagung.
            </div>
        </div>
    </body>
</html>
