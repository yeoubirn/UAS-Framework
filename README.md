# Narendra Media

Aplikasi web profil usaha, katalog layanan, dan pemesanan online untuk **Narendra Media** — usaha jasa dan rental multimedia (rental proyektor, pemasangan CCTV, serta instalasi WiFi & jaringan internet perkantoran dan sekolah) di Tulungagung, Jawa Timur.

Proyek ini dikembangkan sebagai Tugas UAS **Workshop Pemrograman Framework** dengan prinsip kode yang sederhana, bersih, terstruktur, dan mudah dijelaskan oleh mahasiswa.

---

## 🚀 Tech Stack
- **Framework:** Laravel 12
- **Template Engine:** Blade & Blade Components
- **Styling:** Tailwind CSS (via Laravel Breeze)
- **Database:** SQLite
- **Font:** Poppins (Heading) & Inter (Body)

---

## 🗄️ Arsitektur Database (5 Tabel & Transaksi Header-Detail)

Aplikasi ini memenuhi ketentuan tugas minimal **5 Tabel** dan struktur **Transaksi Master-Detail (Header-Detail)**:

1. **`users`** *(Master)*: Mengelola data pengguna (nama, email, password, nomor HP, peran `admin` atau `pelanggan`).
2. **`categories`** *(Master)*: Mengelompokkan jenis layanan (`nama`, `slug`, `deskripsi`).
3. **`services`** *(Master)*: Daftar paket jasa/rental yang berelasi ke `categories` (`category_id`, `nama`, `deskripsi`, `harga`, `tipe`, `gambar`).
4. **`orders`** *(Header Transaksi)*: Menyimpan data umum transaksi (`nomor_pesanan`, `user_id`, `tanggal`, `alamat`, `catatan`, `status`, `total`).
5. **`order_details`** *(Detail Transaksi)*: Menyimpan rincian item layanan dalam setiap transaksi (`order_id`, `service_id`, `jumlah`, `harga_satuan`, `subtotal`).

### Relasi Eloquent:
- `Category` **hasMany** `Service` / `Service` **belongsTo** `Category`
- `User` **hasMany** `Order` / `Order` **belongsTo** `User`
- `Order` **hasMany** `OrderDetail` / `OrderDetail` **belongsTo** `Order`
- `Service` **hasMany** `OrderDetail` / `OrderDetail` **belongsTo** `Service`

---

## ✨ Fitur Utama

1. **Autentikasi & Multi-role:**
   - Registrasi dan Login dengan dua peran: **Admin** dan **Pelanggan**.
   - Input nomor HP saat registrasi.
   - Hak akses rute dan menu navigasi yang terisolasi sesuai peran.
2. **Katalog Layanan (Beranda):**
   - Halaman beranda `/` menyajikan daftar layanan yang dikelompokkan per kategori (*Rental Proyektor*, *Pasang CCTV*, *WiFi dan Jaringan*).
   - Menggunakan komponen kartu `<x-service-card>` yang memuat gambar/ilustrasi, nama layanan, badge kategori, tipe layanan, deskripsi singkat, tarif harga, dan tombol "Lihat Detail".
3. **Detail Layanan & Form Pemesanan Langsung:**
   - Halaman `/layanan/{service}` menampilkan deskripsi lengkap layanan, tarif satuan, dan formulir pemesanan online.
   - Form pemesanan mencakup input jumlah unit, tanggal pelaksanaan/pemasangan, alamat lengkap, dan catatan opsional.
   - Validasi menggunakan Form Request (`StoreOrderRequest`).
   - Setiap transaksi membuat nota pesanan unik (`nomor_pesanan`), header transaksi (`orders`), dan detail transaksi (`order_details`).
   - Status awal transaksi otomatis diatur ke `pending`.
4. **Halaman "Pesanan Saya":**
   - Halaman `/pesanan-saya` bagi pelanggan untuk memantau status pesanan dan rincian transaksi (nomor invoice, rincian unit & subtotal, tanggal pelaksanaan, dan status).
   - Dilengkapi badge status berwarna (*Pending*, *Dikonfirmasi*, *Selesai*, *Ditolak*).
   - Tombol konfirmasi cepat via WhatsApp langsung dengan referensi nomor pesanan.
   - Keamanan data terjamin: pelanggan hanya dapat melihat transaksinya sendiri.
5. **Panel Admin - CRUD Layanan & Kategori:**
   - Admin dapat menambah, mengubah, melihat, dan menghapus layanan dengan relasi dinamis ke tabel kategori.
6. **Panel Admin - Kelola Transaksi Pesanan:**
   - Admin dapat melihat seluruh daftar pesanan pelanggan yang masuk beserta rincian item dari tabel `order_details`, serta memperbarui status transaksi.

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
   php artisan migrate:fresh --seed
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

Untuk memastikan seluruh 50 unit & feature test berjalan normal:

```bash
php vendor/bin/phpunit
```

---

## 📍 Informasi Usaha
- **Nama Usaha:** Narendra Media
- **Layanan:** Rental Proyektor Layar Besar, Pasang Paket & Jasa CCTV, Instalasi WiFi & Jaringan Internet Kantor/Sekolah
- **Alamat:** Bulu, Tanggulwelahan, Kec. Besuki, Kabupaten Tulungagung, Jawa Timur 66275
- **Jam Operasional:** Buka 24 Jam
- **Kontak / Email:** ekowawan818@gmail.com
