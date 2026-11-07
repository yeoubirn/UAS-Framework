<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Sprint1Test extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_with_no_hp_and_has_default_pelanggan_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Ahmad Pelanggan',
            'email' => 'ahmad@example.com',
            'no_hp' => '081299998888',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));

        $user = User::where('email', 'ahmad@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('081299998888', $user->no_hp);
        $this->assertEquals('pelanggan', $user->role);
        $this->assertFalse($user->isAdmin());
    }

    public function test_seeder_populates_admin_customer_services_and_orders(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Check admin user
        $admin = User::where('email', 'admin@narendramedia.test')->first();
        $this->assertNotNull($admin);
        $this->assertEquals('admin', $admin->role);
        $this->assertTrue($admin->isAdmin());

        // Check customer user
        $customer = User::where('email', 'pelanggan@narendramedia.test')->first();
        $this->assertNotNull($customer);
        $this->assertEquals('pelanggan', $customer->role);

        // Check 5 services from BRIEF.md
        $this->assertEquals(5, Service::count());
        $this->assertDatabaseHas('services', [
            'nama' => 'Rental Proyektor Besar',
            'kategori' => 'Rental Proyektor',
            'harga' => 450000,
            'tipe' => 'sewa',
        ]);
        $this->assertDatabaseHas('services', [
            'nama' => 'Proyektor 1 Arah',
            'kategori' => 'Rental Proyektor',
            'harga' => 350000,
            'tipe' => 'sewa',
        ]);
        $this->assertDatabaseHas('services', [
            'nama' => 'Pasang CCTV Paket Lengkap',
            'kategori' => 'Pasang CCTV',
            'harga' => 950000,
            'tipe' => 'jasa',
        ]);
        $this->assertDatabaseHas('services', [
            'nama' => 'Jasa Pasang CCTV',
            'kategori' => 'Pasang CCTV',
            'harga' => 200000,
            'tipe' => 'jasa',
        ]);
        $this->assertDatabaseHas('services', [
            'nama' => 'Pasang WiFi dan Jaringan Kantor/Sekolah',
            'kategori' => 'WiFi dan Jaringan',
            'harga' => 350000,
            'tipe' => 'jasa',
        ]);

        // Check 2 sample orders with different status
        $this->assertEquals(2, Order::count());
        $orders = Order::with(['user', 'service'])->get();
        $this->assertCount(2, $orders);

        $statuses = $orders->pluck('status')->unique();
        $this->assertGreaterThanOrEqual(2, $statuses->count());

        // Test relationships
        $order = $orders->first();
        $this->assertInstanceOf(User::class, $order->user);
        $this->assertInstanceOf(Service::class, $order->service);
        $this->assertTrue($order->user->orders->contains($order));
        $this->assertTrue($order->service->orders->contains($order));
    }

    public function test_components_render_properly(): void
    {
        $badgePending = $this->blade('<x-status-badge status="pending" />');
        $badgePending->assertSee('Pending');

        $badgeDikonfirmasi = $this->blade('<x-status-badge status="dikonfirmasi" />');
        $badgeDikonfirmasi->assertSee('Dikonfirmasi');

        $footer = $this->blade('<x-footer />');
        $footer->assertSee('ekowawan818@gmail.com');
        $footer->assertSee('Tulungagung');
        $footer->assertSee('Buka 24 Jam');
    }
}
