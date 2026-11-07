<footer class="bg-white border-t border-surface-border mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Brand Info -->
            <div>
                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Narendra Media" class="h-9 w-auto object-contain">
                    <span class="font-heading font-bold text-lg text-content-primary">Narendra Media</span>
                </div>
                <p class="text-sm text-content-secondary leading-relaxed">
                    Usaha jasa dan rental terpercaya di Tulungagung. Melayani sewa proyektor, pemasangan CCTV, serta instalasi WiFi & jaringan internet perkantoran dan sekolah.
                </p>
            </div>

            <!-- Operational & Contact Info -->
            <div>
                <h4 class="font-heading font-semibold text-content-primary mb-3">Kontak & Jam Buka</h4>
                <ul class="space-y-2 text-sm text-content-secondary">
                    <li class="flex items-start gap-2">
                        <span class="font-medium text-content-primary">Jam Buka:</span>
                        <span>Buka 24 Jam</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="font-medium text-content-primary">Email:</span>
                        <a href="mailto:ekowawan818@gmail.com" class="text-primary hover:underline">
                            ekowawan818@gmail.com
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Address Info -->
            <div>
                <h4 class="font-heading font-semibold text-content-primary mb-3">Alamat</h4>
                <p class="text-sm text-content-secondary leading-relaxed">
                    Bulu, Tanggulwelahan, Kec. Besuki, Kabupaten Tulungagung, Jawa Timur 66275
                </p>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-surface-border text-center text-xs text-content-secondary">
            &copy; {{ date('Y') }} Narendra Media. Hak cipta dilindungi undang-undang.
        </div>
    </div>
</footer>
