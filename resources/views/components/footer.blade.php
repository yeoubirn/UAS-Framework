<footer class="bg-navy border-t border-navy-light text-slate-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Info & Profile -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Narendra Media" class="h-9 w-auto object-contain bg-white/10 rounded p-1">
                    <span class="font-heading font-bold text-xl text-white">Narendra Media</span>
                </div>
                <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
                    Penyedia solusi multimedia, rental proyektor berkualitas, instalasi CCTV, dan jaringan internet di Tulungagung untuk kebutuhan rumah tangga, instansi sekolah, perkantoran, dan acara.
                </p>
                <div class="mt-4 flex items-center gap-2 text-xs text-cyan-300 font-medium">
                    <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    <span>Pelayanan Ramah, Rapi, & Siap 24 Jam</span>
                </div>
            </div>

            <!-- Quick Links / Layanan Kami -->
            <div>
                <h4 class="font-heading font-semibold text-white text-sm mb-4 uppercase tracking-wider">
                    Layanan Kami
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-300">
                    <li>
                        <a href="{{ url('/#katalog') }}" class="hover:text-white hover:underline transition">Rental Proyektor & Layar</a>
                    </li>
                    <li>
                        <a href="{{ url('/#katalog') }}" class="hover:text-white hover:underline transition">Pemasangan & Servis CCTV</a>
                    </li>
                    <li>
                        <a href="{{ url('/#katalog') }}" class="hover:text-white hover:underline transition">Instalasi WiFi & Jaringan</a>
                    </li>
                    <li>
                        <a href="{{ url('/#katalog') }}" class="hover:text-white hover:underline transition">Jaringan Kantor & Sekolah</a>
                    </li>
                </ul>
            </div>

            <!-- Operational & Contact Info -->
            <div>
                <h4 class="font-heading font-semibold text-white text-sm mb-4 uppercase tracking-wider">
                    Kontak & Lokasi
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm text-slate-300">
                    <li class="flex items-start gap-2">
                        <span class="font-medium text-white">Jam Buka:</span>
                        <span>Buka 24 Jam Nonstop</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-medium text-white">Alamat:</span>
                        <span>Bulu, Tanggulwelahan, Kec. Besuki, Kab. Tulungagung, Jawa Timur 66275</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-medium text-white">Email:</span>
                        <a href="mailto:ekowawan818@gmail.com" class="text-cyan-300 hover:text-white transition">
                            ekowawan818@gmail.com
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-navy-light/60 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-3">
            <div>
                &copy; {{ date('Y') }} <span class="text-white font-medium">Narendra Media</span>. Hak cipta dilindungi undang-undang.
            </div>
            <div class="text-slate-400">
                Workshop Pemrograman Framework
            </div>
        </div>
    </div>
</footer>
