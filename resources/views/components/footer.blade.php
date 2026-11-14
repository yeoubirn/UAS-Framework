<footer class="bg-navy border-t border-navy-light text-slate-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Brand Info -->
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Narendra Media" class="h-9 w-auto object-contain bg-white/10 rounded p-1">
                    <span class="font-heading font-bold text-lg text-white">Narendra Media</span>
                </div>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Layanan jasa pasang CCTV, instalasi WiFi & jaringan, serta rental proyektor di Tulungagung untuk rumah, kantor, sekolah, dan acara.
                </p>
            </div>

            <!-- Operational & Contact Info -->
            <div>
                <h4 class="font-heading font-semibold text-white mb-3">Kontak & Jam Buka</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li class="flex items-start gap-2">
                        <span class="font-medium text-white">Jam Buka:</span>
                        <span>Buka 24 Jam</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-medium text-white">Email:</span>
                        <a href="mailto:ekowawan818@gmail.com" class="text-primary hover:text-white transition">
                            ekowawan818@gmail.com
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Address Info -->
            <div>
                <h4 class="font-heading font-semibold text-white mb-3">Alamat</h4>
                <p class="text-sm text-slate-300 leading-relaxed">
                    Bulu, Tanggulwelahan, Kec. Besuki, Kabupaten Tulungagung, Jawa Timur 66275
                </p>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-navy-light/60 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} Narendra Media. Hak cipta dilindungi undang-undang.
        </div>
    </div>
</footer>
