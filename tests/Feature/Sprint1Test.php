<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
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
        $response->assertRedirect(route('home', absolute: false));

        $user = User::where('email', 'ahmad@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('081299998888', $user->no_hp);
        $this->assertEquals('pelanggan', $user->role);
        $this->assertFalse($user->isAdmin());
    }

    public function test_seeder_populates_admin_customer_categories_services_and_orders(): void
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

        // Check 3 categories
        $this->assertEquals(3, Category::count());
        $this->assertDatabaseHas('categories', ['nama' => 'Rental Proyektor']);
        $this->assertDatabaseHas('categories', ['nama' => 'Pasang CCTV']);
        $this->assertDatabaseHas('categories', ['nama' => 'WiFi dan Jaringan']);

        // Check 5 services
        $this->assertEquals(5, Service::count());
        $this->assertDatabaseHas('services', [
            'nama' => 'Rental Proyektor Besar',
            'harga' => 450000,
            'tipe' => 'sewa',
        ]);

        // Check 2 sample orders and details (Master-Detail)
        $this->assertEquals(2, Order::count());
        $this->assertEquals(2, OrderDetail::count());

        $orders = Order::with(['user', 'orderDetails.service'])->get();
        $this->assertCount(2, $orders);

        $statuses = $orders->pluck('status')->unique();
        $this->assertGreaterThanOrEqual(2, $statuses->count());

        // Test relationships
        $order = $orders->first();
        $this->assertInstanceOf(User::class, $order->user);
        $this->assertTrue($order->user->orders->contains($order));

        $detail = $order->orderDetails->first();
        $this->assertInstanceOf(OrderDetail::class, $detail);
        $this->assertInstanceOf(Service::class, $detail->service);
    }

    public function test_components_render_properly(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Test status badge component
        $pendingBadge = $this->blade('<x-status-badge status="pending" />');
        $pendingBadge->assertSee('Pending');

        $confirmedBadge = $this->blade('<x-status-badge status="dikonfirmasi" />');
        $confirmedBadge->assertSee('Dikonfirmasi');

        $completedBadge = $this->blade('<x-status-badge status="selesai" />');
        $completedBadge->assertSee('Selesai');

        $rejectedBadge = $this->blade('<x-status-badge status="ditolak" />');
        $rejectedBadge->assertSee('Ditolak');

        // Test footer component
        $footer = $this->blade('<x-footer />');
        $footer->assertSee('Narendra Media');
        $footer->assertSee('Buka 24 Jam');
        $footer->assertSee('ekowawan818@gmail.com');
        $footer->assertSee('Besuki, Kabupaten Tulungagung');
    }
}
