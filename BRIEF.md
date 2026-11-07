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
tabel kategori terpisah, upload foto, payment gateway, notifikasi, pelacakan tanpa login.

## Tabel (3 saja)
- users: name, email, password, role (admin/pelanggan, default pelanggan), no_hp
- services: nama, kategori (teks: Rental Proyektor/Pasang CCTV/WiFi dan Jaringan), deskripsi, harga, tipe (sewa/jasa), gambar (path teks di public/images)
- orders: user_id, service_id, jumlah, tanggal (tanggal pakai/pasang), alamat, catatan, status (pending/dikonfirmasi/selesai/ditolak), total
Relasi: user hasMany orders; service hasMany orders; order belongsTo user dan service.

## Karakter visual
Profesional, bersih, modern, ramah. Mobile-first.

## Palet warna
| Peran | Warna |
|---|---|
| Primary | #1D4ED8 |
| Primary gelap | #1E3A8A |
| Aksen / tombol utama | #F59E0B |
| Background | #F8FAFC |
| Kartu | #FFFFFF |
| Teks utama | #0F172A |
| Teks sekunder | #64748B |
| Border | #E2E8F0 |
Status: pending = #F59E0B, dikonfirmasi = #2563EB, selesai = #16A34A, ditolak = #DC2626

## Tipografi
Judul: Poppins. Isi: Inter.

## UI
Kartu layanan rounded-xl, bayangan tipis. Tombol utama warna aksen. Badge status berwarna.
Navbar: logo, menu, hamburger di HP. Footer: alamat, jam buka, email.
Teks UI Bahasa Indonesia. Format harga: Rp 450.000.

## Data seeder
- Rental Proyektor Besar: 450000, layar 4x3 (sewa, kategori Rental Proyektor)
- Proyektor 1 arah: 350000, layar 3x3 (sewa, kategori Rental Proyektor)
- Pasang CCTV: 950000, mulai harga (jasa, kategori Pasang CCTV)
- Jasa Pasang CCTV: 200000 (jasa, kategori Pasang CCTV)
- Pasang WiFi dan Jaringan Kantor/Sekolah: 350000 (jasa, kategori WiFi dan Jaringan)
