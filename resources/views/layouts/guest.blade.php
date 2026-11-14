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
    <body class="font-sans antialiased bg-navy text-content-primary">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 px-4 py-8 bg-hero-grid">
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Narendra Media" class="h-16 w-auto object-contain bg-white/10 rounded-md p-1.5">
                    <span class="font-heading font-bold text-2xl text-white">Narendra Media</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white border border-surface-border rounded-lg shadow-md p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
