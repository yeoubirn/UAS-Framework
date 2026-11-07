<?php

namespace Database\Seeders;

use App\Models\Order;
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

        // 3. Data Layanan (5 Layanan dari BRIEF.md)
        $service1 = Service::create([
            'nama' => 'Rental Proyektor Besar',
            'kategori' => 'Rental Proyektor',
            'deskripsi' => 'Paket sewa proyektor layar besar 4x3 meter, cocok untuk acara outdoor, pernikahan, dan seminar besar.',
            'harga' => 450000,
            'tipe' => 'sewa',
            'gambar' => null,
        ]);

        $service2 = Service::create([
            'nama' => 'Proyektor 1 Arah',
            'kategori' => 'Rental Proyektor',
            'deskripsi' => 'Sewa proyektor 1 arah dengan layar 3x3 meter, ideal untuk rapat, nobar, dan presentasi indoor.',
            'harga' => 350000,
            'tipe' => 'sewa',
            'gambar' => null,
        ]);

        $service3 = Service::create([
            'nama' => 'Pasang CCTV Paket Lengkap',
            'kategori' => 'Pasang CCTV',
            'deskripsi' => 'Instalasi paket CCTV lengkap (unit kamera, DVR, kabel, setting online ke HP). Mulai harga Rp 950.000.',
            'harga' => 950000,
            'tipe' => 'jasa',
            'gambar' => null,
        ]);

        $service4 = Service::create([
            'nama' => 'Jasa Pasang CCTV',
            'kategori' => 'Pasang CCTV',
            'deskripsi' => 'Jasa instalasi kamera CCTV dan penarikan kabel (per titik).',
            'harga' => 200000,
            'tipe' => 'jasa',
            'gambar' => null,
        ]);

        $service5 = Service::create([
            'nama' => 'Pasang WiFi dan Jaringan Kantor/Sekolah',
            'kategori' => 'WiFi dan Jaringan',
            'deskripsi' => 'Pemasangan dan konfigurasi jaringan internet kabel LAN dan router WiFi untuk instansi, kantor, atau sekolah.',
            'harga' => 350000,
            'tipe' => 'jasa',
            'gambar' => null,
        ]);

        // 4. Dua Pesanan Contoh dengan Status Berbeda
        Order::create([
            'user_id' => $customer->id,
            'service_id' => $service1->id,
            'jumlah' => 1,
            'tanggal' => '2026-11-10',
            'alamat' => 'Bulu, Tanggulwelahan, Kec. Besuki, Kabupaten Tulungagung',
            'catatan' => 'Acara pertemuan warga mulai pukul 19.00 WIB',
            'status' => 'pending',
            'total' => 450000,
        ]);

        Order::create([
            'user_id' => $customer->id,
            'service_id' => $service5->id,
            'jumlah' => 1,
            'tanggal' => '2026-11-12',
            'alamat' => 'Jl. Raya Besuki No. 25, Kec. Besuki, Kabupaten Tulungagung',
            'catatan' => 'Pemasangan router di lantai 2 gedung sekolah',
            'status' => 'dikonfirmasi',
            'total' => 350000,
        ]);
    }
}
