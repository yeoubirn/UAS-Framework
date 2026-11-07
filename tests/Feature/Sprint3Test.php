<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Sprint3Test extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $customer;
    private Service $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);

        $this->admin = User::where('email', 'admin@narendramedia.test')->first();
        $this->customer = User::where('email', 'pelanggan@narendramedia.test')->first();
        $this->service = Service::where('nama', 'Rental Proyektor Besar')->first();
    }

    public function test_home_page_displays_services_grouped_by_category_with_service_card(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Memastikan judul kategori muncul
        $response->assertSee('Rental Proyektor');
        $response->assertSee('Pasang CCTV');
        $response->assertSee('WiFi dan Jaringan');

        // Memastikan elemen kartu layanan muncul
        $response->assertSee('Rental Proyektor Besar');
        $response->assertSee('Rp 450.000');
        $response->assertSee('Lihat Detail');
        $response->assertSee('/layanan/' . $this->service->id);

        // Memastikan komponen x-service-card dirender
        $card = $this->blade('<x-service-card :service="$service" />', ['service' => $this->service]);
        $card->assertSee('Rental Proyektor Besar');
        $card->assertSee('Rp 450.000');
        $card->assertSee('Lihat Detail');
    }

    public function test_service_detail_page_can_be_viewed_by_guest_and_shows_login_prompt(): void
    {
        $response = $this->get('/layanan/' . $this->service->id);

        $response->assertStatus(200);
        $response->assertSee($this->service->nama);
        $response->assertSee('Rp 450.000');
        $response->assertSee($this->service->deskripsi);

        // Guest diarahkan untuk masuk/login jika ingin memesan
        $response->assertSee('Silakan Masuk untuk Memesan');
        $response->assertSee(route('login'));
        $response->assertDontSee('Pesan Layanan Sekarang');
    }

    public function test_service_detail_page_shows_order_form_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->customer)->get('/layanan/' . $this->service->id);

        $response->assertStatus(200);
        $response->assertSee('Form Pemesanan');
        $response->assertSee('Pesan Layanan Sekarang');
        $response->assertSee('Jumlah');
        $response->assertSee('Tanggal Pemakaian / Pemasangan');
        $response->assertSee('Alamat Lengkap');
        $response->assertSee('Catatan Tambahan');
    }

    public function test_guest_is_redirected_to_login_when_attempting_to_order(): void
    {
        $response = $this->post('/layanan/' . $this->service->id . '/pesan', [
            'jumlah' => 2,
            'tanggal' => '2026-11-20',
            'alamat' => 'Desa Tanggulwelahan, Tulungagung',
            'catatan' => 'Pesan tanpa login',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('orders', [
            'alamat' => 'Desa Tanggulwelahan, Tulungagung',
        ]);
    }

    public function test_authenticated_user_can_place_order_with_server_calculated_total_and_pending_status(): void
    {
        $payload = [
            'jumlah' => 3,
            'tanggal' => '2026-11-25',
            'alamat' => 'Jalan Pahlawan No. 45, Kedungwaru, Tulungagung',
            'catatan' => 'Harap konfirmasi kedatangan 1 jam sebelumnya.',
        ];

        $response = $this->actingAs($this->customer)
            ->post('/layanan/' . $this->service->id . '/pesan', $payload);

        $response->assertRedirect(route('orders.my'));
        $response->assertSessionHas('success');

        // Total dihitung di server: 450.000 x 3 = 1.350.000
        $expectedTotal = $this->service->harga * 3;

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->customer->id,
            'service_id' => $this->service->id,
            'jumlah' => 3,
            'tanggal' => '2026-11-25 00:00:00',
            'alamat' => 'Jalan Pahlawan No. 45, Kedungwaru, Tulungagung',
            'catatan' => 'Harap konfirmasi kedatangan 1 jam sebelumnya.',
            'status' => 'pending',
            'total' => $expectedTotal,
        ]);
    }

    public function test_order_validation_fails_for_missing_required_fields(): void
    {
        $response = $this->actingAs($this->customer)
            ->post('/layanan/' . $this->service->id . '/pesan', [
                'jumlah' => 0, // min 1
                'tanggal' => 'bukan-tanggal',
                'alamat' => '',
            ]);

        $response->assertSessionHasErrors(['jumlah', 'tanggal', 'alamat']);
    }

    public function test_customer_can_view_my_orders_page_with_status_badge(): void
    {
        $response = $this->actingAs($this->customer)->get('/pesanan-saya');

        $response->assertStatus(200);
        $response->assertSee('Pesanan Saya');
        $response->assertSee('Rental Proyektor Besar');
        $response->assertSee('Rp 450.000');
        // Badge status dari database seeder customer
        $response->assertSee('Pending');
        $response->assertSee('Dikonfirmasi');
    }

    public function test_user_cannot_see_other_users_orders(): void
    {
        // Buat user baru (pelanggan lain)
        $otherCustomer = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'password' => bcrypt('password'),
            'role' => 'pelanggan',
            'no_hp' => '085566778899',
        ]);

        // Buat pesanan khusus milik siti
        $otherOrder = Order::create([
            'user_id' => $otherCustomer->id,
            'service_id' => $this->service->id,
            'jumlah' => 5,
            'tanggal' => '2026-12-01',
            'alamat' => 'Alamat Rahasia Milik Siti Tulungagung',
            'catatan' => 'Catatan Rahasia Siti',
            'status' => 'pending',
            'total' => 2250000,
        ]);

        // Login sebagai customer pertama (Budi)
        $responseBudi = $this->actingAs($this->customer)->get('/pesanan-saya');
        $responseBudi->assertStatus(200);
        $responseBudi->assertDontSee('Alamat Rahasia Milik Siti Tulungagung');
        $responseBudi->assertDontSee('Catatan Rahasia Siti');

        // Login sebagai Siti, harus melihat pesanannya sendiri tapi tidak melihat pesanan Budi dari seeder
        $responseSiti = $this->actingAs($otherCustomer)->get('/pesanan-saya');
        $responseSiti->assertStatus(200);
        $responseSiti->assertSee('Alamat Rahasia Milik Siti Tulungagung');
        $responseSiti->assertSee('Catatan Rahasia Siti');
        $responseSiti->assertDontSee('Acara pertemuan warga mulai pukul 19.00 WIB');
        $responseSiti->assertDontSee('Pemasangan router di lantai 2 gedung sekolah');
    }

    public function test_navbar_shows_pesanan_saya_only_for_pelanggan(): void
    {
        // 1. Pelanggan melihat "Pesanan Saya" di navbar
        $customerView = $this->actingAs($this->customer)->get('/dashboard');
        $customerView->assertSee('Pesanan Saya');
        $customerView->assertSee(route('orders.my'));

        // 2. Admin TIDAK melihat "Pesanan Saya", melainkan "Layanan" dan "Pesanan" admin
        $adminView = $this->actingAs($this->admin)->get('/dashboard');
        $adminView->assertDontSee(route('orders.my'));
        $adminView->assertSee(route('admin.services.index'));
        $adminView->assertSee(route('admin.orders.index'));

        // 3. Guest tidak melihat "Pesanan Saya"
        $guestView = $this->get('/');
        $guestView->assertDontSee('Pesanan Saya');
    }
}
