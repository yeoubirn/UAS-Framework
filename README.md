# Narendra Media

Aplikasi web profil usaha, katalog layanan, dan pemesanan online untuk **Narendra Media** — usaha jasa dan rental multimedia (rental proyektor, pemasangan CCTV, serta instalasi WiFi & jaringan internet perkantoran dan sekolah) di Tulungagung, Jawa Timur.

Proyek ini dikembangkan sebagai Tugas UAS **Workshop Pemrograman Framework** dengan prinsip kode yang sederhana, bersih, dan mudah dijelaskan oleh mahasiswa.

---

## 🚀 Tech Stack
- **Framework:** Laravel 12
- **Template Engine:** Blade & Blade Components
- **Styling:** Tailwind CSS (via Laravel Breeze)
- **Database:** SQLite
- **Font:** Poppins (Heading) & Inter (Body)

---

## ✨ Fitur Utama
1. **Autentikasi & Multi-role:**
   - Registrasi dan Login dengan dua peran: **Admin** dan **Pelanggan**.
   - Input nomor HP saat registrasi.
   - Hak akses rute dan menu navbar yang terisolasi sesuai peran.
2. **Katalog Layanan (Beranda):**
   - Halaman beranda `/` menyajikan daftar layanan yang dikelompokkan per kategori (*Rental Proyektor*, *Pasang CCTV*, *WiFi dan Jaringan*).
   - Menggunakan komponen kartu `<x-service-card>` yang memuat gambar/ilustrasi, nama layanan, badge kategori, tipe layanan, deskripsi singkat, tarif harga, dan tombol "Lihat Detail".
3. **Detail Layanan & Form Pemesanan Langsung:**
   - Halaman `/layanan/{service}` menampilkan deskripsi lengkap layanan, tarif satuan, dan formulir pemesanan online (satu pesanan = satu layanan).
   - Form pemesanan mencakup input jumlah unit, tanggal pelaksanaan/pemasangan, alamat lengkap, dan catatan opsional.
   - Hanya user yang login yang dapat memesan. Pengunjung yang belum login akan diarahkan untuk masuk ke akun terlebih dahulu.
   - Validasi data menggunakan Form Request (`StoreOrderRequest`).
   - Total biaya pesanan dihitung secara aman di sisi server (`harga x jumlah`).
   - Status awal pesanan otomatis diatur ke `pending`.
4. **Halaman "Pesanan Saya":**
   - Halaman `/pesanan-saya` bagi pelanggan untuk memantau status pesanan pribadi secara real-time.
   - Dilengkapi badge status berwarna (*Pending*, *Dikonfirmasi*, *Selesai*, *Ditolak*).
   - Privasi dan keamanan data terjamin: pelanggan hanya dapat melihat pesanannya sendiri dan tidak dapat melihat pesanan pelanggan lain.
   - Tombol menu navigasi **"Pesanan Saya"** tersedia di navbar khusus pelanggan.
5. **Panel Admin - CRUD Layanan:**
   - Admin dapat menambah layanan baru, mengubah data layanan, melihat daftar layanan, dan menghapus layanan.
6. **Panel Admin - Kelola Pesanan:**
   - Admin dapat melihat seluruh daftar pesanan pelanggan yang masuk beserta detailnya, serta memperbarui status pesanan (*Pending*, *Dikonfirmasi*, *Selesai*, *Ditolak*).

---

## 📦 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal:

1. **Clone repository dan masuk ke direktori proyek:**
   ```bash
   git clone <url-repository>
   cd "Project UAS"
   ```

2. **Pasang dependensi PHP melalui Composer:**
   ```bash
   composer install
   ```

3. **Salin berkas konfigurasi lingkungan (.env):**
   - Di Windows (PowerShell / Command Prompt):
     ```bash
     copy .env.example .env
     ```
   - Di Linux / macOS / Bash:
     ```bash
     cp .env.example .env
     ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan migrasi database beserta seeder awal:**
   ```bash
   php artisan migrate --seed
   ```

6. **Pasang dependensi frontend:**
   ```bash
   npm install
   ```

7. **Kompilasi asset frontend (Tailwind CSS & JavaScript):**
   ```bash
   npm run build
   ```

8. **Jalankan server lokal Laravel:**
   ```bash
   php artisan serve
   ```

9. Buka peramban (browser) di tautan:
   [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 👥 Akun Demo

Database seeder telah menyediakan dua akun demo siap pakai:

| Peran (Role) | Email | Password | Keterangan |
|---|---|---|---|
| **Admin** | `admin@narendramedia.test` | `password` | Mengelola data layanan dan memperbarui status pesanan |
| **Pelanggan** | `pelanggan@narendramedia.test` | `password` | Memesan layanan dan melihat riwayat di "Pesanan Saya" |

---

## 🧪 Menjalankan Pengujian (Testing)

Untuk memastikan seluruh fitur dan spesifikasi berjalan normal, jalankan perintah pengujian:

```bash
php artisan test
```

---

## 📍 Informasi Usaha
- **Nama Usaha:** Narendra Media
- **Layanan:** Rental Proyektor Layar Besar, Pasang Paket & Jasa CCTV, Instalasi WiFi & Jaringan Internet Kantor/Sekolah
- **Alamat:** Bulu, Tanggulwelahan, Kec. Besuki, Kabupaten Tulungagung, Jawa Timur 66275
- **Jam Operasional:** Buka 24 Jam
- **Kontak / Email:** ekowawan818@gmail.com
