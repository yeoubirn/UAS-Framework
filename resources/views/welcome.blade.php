<x-app-layout>
    <div class="py-12 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-block px-3.5 py-1.5 bg-blue-50 text-primary font-semibold text-xs rounded-full border border-blue-200 tracking-wide mb-5">
                    Jasa & Rental Tulungagung • Buka 24 Jam
                </span>
                <h1 class="font-heading font-bold text-3xl sm:text-5xl text-content-primary tracking-tight leading-tight">
                    Solusi Digital & Rental Multimedia Terpercaya
                </h1>
                <p class="mt-4 text-base sm:text-lg text-content-secondary leading-relaxed">
                    Narendra Media melayani rental proyektor layar besar, paket pasang CCTV, serta instalasi WiFi & jaringan perkantoran dan sekolah dengan teknisi handal dan harga terjangkau.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold rounded-xl shadow-sm transition">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 bg-accent hover:bg-accent-hover text-white font-semibold rounded-xl shadow-sm transition">
                            Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white hover:bg-gray-50 text-content-primary border border-surface-border font-semibold rounded-xl shadow-sm transition">
                            Masuk ke Akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
