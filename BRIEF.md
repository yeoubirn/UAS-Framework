# Brief Proyek: Narendra Media

## Tentang usaha
Narendra Media: usaha jasa dan rental di Tulungagung, Jawa Timur.
Layanan: pasang WiFi, pasang CCTV, jaringan internet perkantoran/sekolah, rental proyektor.
Buka 24 jam. Kontak: ekowawan818@gmail.com
Alamat: Bulu, Tanggulwelahan, Kec. Besuki, Kabupaten Tulungagung, Jawa Timur 66275

## Tujuan
Aplikasi sederhana agar pelanggan bisa melihat layanan dan memesan online, dan pemilik
bisa mengelola layanan serta pesanan. Ini tugas UAS Workshop Pemrograman Framework,
jadi fokus pada kode yang bersih dan mudah dijelaskan, bukan fitur yang banyak.

## Pengguna
- Pelanggan: mayoritas buka dari HP.
- Admin: pemilik usaha, awam teknis, butuh tampilan sederhana.

## Fitur (HANYA ini)
1. Register dan login, dengan role admin dan pelanggan
2. Admin: CRUD layanan
3. Admin: lihat daftar pesanan dan ubah status
4. Pelanggan: lihat katalog layanan dan detail layanan
5. Pelanggan: pesan langsung dari halaman detail layanan (satu pesanan = satu layanan)
6. Pelanggan: halaman "Pesanan Saya"

## Di luar lingkup (JANGAN dibuat)
Keranjang, checkout multi-item, cek bentrok jadwal, statistik/grafik, pencarian dan filter,
upload foto, payment gateway, notifikasi, pelacakan tanpa login.

## Tabel (5 Tabel - Sesuai Ketentuan Tugas & Relasi Transaksi Header-Detail)
1. users: name, email, password, role (admin/pelanggan, default pelanggan), no_hp
2. categories: nama, slug, deskripsi
3. services: category_id, nama, deskripsi, harga, tipe (sewa/jasa), gambar (path teks di public/images)
4. orders (Header Transaksi): nomor_pesanan, user_id, tanggal (tanggal pakai/pasang), alamat, catatan, status (pending/dikonfirmasi/selesai/ditolak), total
5. order_details (Detail Transaksi): order_id, service_id, jumlah, harga_satuan, subtotal

Relasi:
- category hasMany services; service belongsTo category
- user hasMany orders; order belongsTo user
- order hasMany order_details; order_detail belongsTo order
- service hasMany order_details; order_detail belongsTo service

## Karakter visual
Profesional, bersih, modern, ramah. Mobile-first.

## Palet warna
| Peran | Warna |
|---|---|
| Primary (cyan) | #06B6D4 |
| Primary gelap | #0891B2 |
| Navy (hero, footer, teks judul) | #0B1F4B |
| Aksen / tombol utama | #F97316 |
| Background halaman | #F0F9FF |
| Kartu | #FFFFFF |
| Border | #BAE6FD |
| Teks utama | #0F172A |
| Teks sekunder | #475569 |
Kategori: Rental Proyektor = #7C3AED, Pasang CCTV = #EA580C, WiFi dan Jaringan = #0891B2  
Status: pending = #F59E0B, dikonfirmasi = #2563EB, selesai = #16A34A, ditolak = #DC2626

## Tipografi
Judul: Poppins (line-height ~1.3, tanpa tracking-tight berlebihan). Isi: Inter.

## UI
Kartu layanan rounded-lg, border 1px #BAE6FD, tanpa bayangan saat diam, bayangan tipis hanya saat hover.
Placeholder gambar: blok warna solid sesuai kategori dengan nama kategori. Harga paling menonjol, tombol "Lihat Detail" ukuran penuh di bawah kartu.
Label tipe ("Sewa" / "Jasa"): kotak kecil (rounded-md), latar solid warna kategori, teks putih, huruf kapital kecil dengan tracking lebar.
Judul kategori: garis tebal 4px berwarna kategori di sisi kiri teks, tanpa lencana/ikon dalam lingkaran. Jumlah layanan: teks abu polos kecil ("X layanan") tanpa kotak.
Hero beranda: rata kiri, latar navy solid dengan pola grid/garis halus, judul putih besar, satu paragraf spesifik, tombol "Lihat Layanan" (oranye) dan "Hubungi via WhatsApp" (outline putih).
Baris info di bawah hero: polos dipisah garis tipis vertikal (Buka 24 jam | Besuki, Tulungagung | Alamat email).
Navbar putih dengan border bawah 1px, menu aktif garis bawah cyan. Footer navy dengan teks terang.
Tombol utama oranye solid (rounded-md), tombol sekunder outline cyan.
Halaman login/register: latar navy, kartu putih di tengah dengan sudut rounded-lg.
Teks UI Bahasa Indonesia. Format harga: Rp 450.000.

## Data seeder
- Rental Proyektor Besar: 450000, layar 4x3 (sewa, kategori Rental Proyektor)
- Proyektor 1 arah: 350000, layar 3x3 (sewa, kategori Rental Proyektor)
- Pasang CCTV: 950000, mulai harga (jasa, kategori Pasang CCTV)
- Jasa Pasang CCTV: 200000 (jasa, kategori Pasang CCTV)
- Pasang WiFi dan Jaringan Kantor/Sekolah: 350000 (jasa, kategori WiFi dan Jaringan)
