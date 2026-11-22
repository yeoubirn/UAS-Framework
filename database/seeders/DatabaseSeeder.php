<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::create([
            'name' => 'Admin Narendra Media',
            'email' => 'admin@narendramedia.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'no_hp' => '081234567890',
        ]);

        // 2. Akun Pelanggan Contoh
        $customer = User::create([
            'name' => 'Budi Santoso',
            'email' => 'pelanggan@narendramedia.test',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
            'no_hp' => '082198765432',
        ]);

        // 3. Data Kategori (3 Kategori)
        $catProyektor = Category::create([
            'nama' => 'Rental Proyektor',
            'slug' => 'rental-proyektor',
            'deskripsi' => 'Penyewaan proyektor dan layar untuk berbagai acara indoor maupun outdoor di Tulungagung.',
        ]);

        $catCctv = Category::create([
            'nama' => 'Pasang CCTV',
            'slug' => 'pasang-cctv',
            'deskripsi' => 'Layanan instalasi kamera pengawas CCTV rumah, toko, dan kantor dengan setting online ke HP.',
        ]);

        $catWifi = Category::create([
            'nama' => 'WiFi dan Jaringan',
            'slug' => 'wifi-dan-jaringan',
            'deskripsi' => 'Pemasangan router WiFi, instalasi kabel LAN, dan konfigurasi jaringan kantor atau sekolah.',
        ]);

        // 4. Data Layanan (5 Layanan berelasi ke Category)
        $service1 = Service::create([
            'category_id' => $catProyektor->id,
            'nama' => 'Rental Proyektor Besar',
            'deskripsi' => 'Paket sewa proyektor layar besar 4x3 meter, cocok untuk acara outdoor, pernikahan, dan seminar besar.',
            'harga' => 450000,
            'tipe' => 'sewa',
            'gambar' => null,
        ]);

        $service2 = Service::create([
            'category_id' => $catProyektor->id,
            'nama' => 'Proyektor 1 Arah',
            'deskripsi' => 'Sewa proyektor 1 arah dengan layar 3x3 meter, ideal untuk rapat, nobar, dan presentasi indoor.',
            'harga' => 350000,
            'tipe' => 'sewa',
            'gambar' => null,
        ]);

        $service3 = Service::create([
            'category_id' => $catCctv->id,
            'nama' => 'Pasang CCTV Paket Lengkap',
            'deskripsi' => 'Instalasi paket CCTV lengkap (unit kamera, DVR, kabel, setting online ke HP). Mulai harga Rp 950.000.',
            'harga' => 950000,
            'tipe' => 'jasa',
            'gambar' => null,
        ]);

        $service4 = Service::create([
            'category_id' => $catCctv->id,
            'nama' => 'Jasa Pasang CCTV',
            'deskripsi' => 'Jasa instalasi kamera CCTV dan penarikan kabel (per titik).',
            'harga' => 200000,
            'tipe' => 'jasa',
            'gambar' => null,
        ]);

        $service5 = Service::create([
            'category_id' => $catWifi->id,
            'nama' => 'Pasang WiFi dan Jaringan Kantor/Sekolah',
            'deskripsi' => 'Pemasangan dan konfigurasi jaringan internet kabel LAN dan router WiFi untuk instansi, kantor, atau sekolah.',
            'harga' => 350000,
            'tipe' => 'jasa',
            'gambar' => null,
        ]);

        // 5. Dua Transaksi Header-Detail Contoh dengan Status Berbeda
        $order1 = Order::create([
            'nomor_pesanan' => 'ORD-20261110-001',
            'user_id' => $customer->id,
            'tanggal' => '2026-11-10',
            'alamat' => 'Bulu, Tanggulwelahan, Kec. Besuki, Kabupaten Tulungagung',
            'catatan' => 'Acara pertemuan warga mulai pukul 19.00 WIB',
            'status' => 'pending',
            'total' => 450000,
        ]);

        OrderDetail::create([
            'order_id' => $order1->id,
            'service_id' => $service1->id,
            'jumlah' => 1,
            'harga_satuan' => 450000,
            'subtotal' => 450000,
        ]);

        $order2 = Order::create([
            'nomor_pesanan' => 'ORD-20261112-002',
            'user_id' => $customer->id,
            'tanggal' => '2026-11-12',
            'alamat' => 'Jl. Raya Besuki No. 25, Kec. Besuki, Kabupaten Tulungagung',
            'catatan' => 'Pemasangan router di lantai 2 gedung sekolah',
            'status' => 'dikonfirmasi',
            'total' => 350000,
        ]);

        OrderDetail::create([
            'order_id' => $order2->id,
            'service_id' => $service5->id,
            'jumlah' => 1,
            'harga_satuan' => 350000,
            'subtotal' => 350000,
        ]);
    }
}
