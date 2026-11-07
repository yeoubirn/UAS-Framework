<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Sprint2Test extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $customer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);

        $this->admin = User::where('email', 'admin@narendramedia.test')->first();
        $this->customer = User::where('email', 'pelanggan@narendramedia.test')->first();
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_routes(): void
    {
        $response = $this->get('/admin/services');
        $response->assertRedirect('/login');

        $responseOrders = $this->get('/admin/orders');
        $responseOrders->assertRedirect('/login');
    }

    public function test_non_admin_gets_403_when_accessing_admin_routes(): void
    {
        $response = $this->actingAs($this->customer)->get('/admin/services');
        $response->assertStatus(403);

        $responseOrders = $this->actingAs($this->customer)->get('/admin/orders');
        $responseOrders->assertStatus(403);
    }

    public function test_admin_redirected_to_admin_services_after_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@narendramedia.test',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($this->admin);
        $response->assertRedirect('/admin/services');
    }

    public function test_customer_redirected_to_dashboard_after_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'pelanggan@narendramedia.test',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($this->customer);
        $response->assertRedirect('/dashboard');
    }

    public function test_admin_can_view_services_index(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/services');

        $response->assertStatus(200);
        $response->assertSee('Rental Proyektor Besar');
        $response->assertSee('Pasang CCTV Paket Lengkap');
        $response->assertSee('Tambah Layanan');
    }

    public function test_admin_can_view_create_service_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/services/create');

        $response->assertStatus(200);
        $response->assertSee('Rental Proyektor');
        $response->assertSee('Pasang CCTV');
        $response->assertSee('WiFi dan Jaringan');
    }

    public function test_admin_can_store_new_service_with_validation(): void
    {
        $payload = [
            'nama' => 'Paket Sewa Proyektor Mini',
            'kategori' => 'Rental Proyektor',
            'deskripsi' => 'Cocok untuk rapat kecil 10-20 orang.',
            'harga' => 250000,
            'tipe' => 'sewa',
            'gambar' => 'images/proyektor-mini.png',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/services', $payload);

        $response->assertRedirect('/admin/services');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('services', [
            'nama' => 'Paket Sewa Proyektor Mini',
            'kategori' => 'Rental Proyektor',
            'harga' => 250000,
        ]);
    }

    public function test_store_service_validation_fails_for_invalid_category_or_missing_fields(): void
    {
        $invalidPayload = [
            'nama' => '',
            'kategori' => 'Kategori Tidak Ada',
            'deskripsi' => '',
            'harga' => 'bukan-angka',
            'tipe' => 'invalid-tipe',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/services', $invalidPayload);
        $response->assertSessionHasErrors(['nama', 'kategori', 'deskripsi', 'harga', 'tipe']);
    }

    public function test_admin_can_edit_and_update_service(): void
    {
        $service = Service::first();

        $response = $this->actingAs($this->admin)->get('/admin/services/' . $service->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($service->nama);

        $updatePayload = [
            'nama' => 'Layanan Update Nama',
            'kategori' => 'Pasang CCTV',
            'deskripsi' => 'Deskripsi layanan yang telah diperbarui.',
            'harga' => 999000,
            'tipe' => 'jasa',
            'gambar' => null,
        ];

        $updateResponse = $this->actingAs($this->admin)->put('/admin/services/' . $service->id, $updatePayload);
        $updateResponse->assertRedirect('/admin/services');
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'nama' => 'Layanan Update Nama',
            'harga' => 999000,
        ]);
    }

    public function test_admin_can_delete_service(): void
    {
        $newService = Service::create([
            'nama' => 'Layanan Mau Dihapus',
            'kategori' => 'WiFi dan Jaringan',
            'deskripsi' => 'Deskripsi layanan sementara.',
            'harga' => 100000,
            'tipe' => 'jasa',
            'gambar' => null,
        ]);

        $response = $this->actingAs($this->admin)->delete('/admin/services/' . $newService->id);
        $response->assertRedirect('/admin/services');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('services', ['id' => $newService->id]);
    }

    public function test_admin_can_view_orders_page_with_details(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/orders');

        $response->assertStatus(200);
        $response->assertSee($this->customer->name);
        $response->assertSee('Kelola Pesanan');
        $response->assertSee('Pending');
        $response->assertSee('Dikonfirmasi');
    }

    public function test_admin_can_update_order_status(): void
    {
        $order = Order::where('status', 'pending')->first();
        $this->assertNotNull($order);

        $response = $this->actingAs($this->admin)->patch('/admin/orders/' . $order->id . '/status', [
            'status' => 'selesai',
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals('selesai', $order->fresh()->status);
    }

    public function test_admin_nav_menu_visible_only_to_admin(): void
    {
        $adminView = $this->actingAs($this->admin)->get('/dashboard');
        $adminView->assertSee('Layanan');
        $adminView->assertSee('Pesanan');

        $customerView = $this->actingAs($this->customer)->get('/dashboard');
        $customerView->assertDontSee('/admin/services');
        $customerView->assertDontSee('/admin/orders');
    }
}
