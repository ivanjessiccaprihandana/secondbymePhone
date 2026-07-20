<?php

namespace Tests\Feature;

use App\Models\Preorder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PreorderTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_preorder_is_saved_before_redirecting_to_whatsapp(): void
    {
        $response = $this->post('/preorder', [
            'customer_name' => 'Budi',
            'whatsapp' => '081234567890',
            'phone_series' => 'Samsung Galaxy S24',
            'storage' => '8/256GB',
            'color' => 'Hitam',
            'notes' => 'Unit mulus',
        ]);

        $response->assertRedirectContains('https://wa.me/6281222621419');
        $this->assertDatabaseHas('preorders', ['customer_name' => 'Budi', 'status' => 'baru']);
    }

    public function test_guest_cannot_open_preorder_admin_page(): void
    {
        $this->get('/admin/preorders')->assertRedirect('/admin/login');
    }

    public function test_admin_can_change_preorder_status(): void
    {
        $preorder = Preorder::create([
            'customer_name' => 'Budi', 'whatsapp' => '0812', 'phone_series' => 'iPhone 15',
            'storage' => '128GB', 'color' => 'Hitam', 'status' => 'baru',
        ]);

        $this->actingAs(User::factory()->create())
            ->patch("/admin/preorders/{$preorder->id}", ['status' => 'diproses'])
            ->assertRedirect();

        $this->assertDatabaseHas('preorders', ['id' => $preorder->id, 'status' => 'diproses']);
    }

    public function test_admin_dashboard_pages_can_be_rendered(): void
    {
        $admin = User::factory()->create();

        $this->actingAs($admin)->get('/admin/products')->assertOk();
        $this->actingAs($admin)->get('/admin/products/create')->assertOk();
        $this->actingAs($admin)->get('/admin/preorders')->assertOk();
        $this->actingAs($admin)->get('/admin/profile')->assertOk();
    }

    public function test_admin_products_are_grouped_by_iphone_generation(): void
    {
        $admin = User::factory()->create();

        foreach (['iPhone 13', 'iPhone 13 Pro', 'iPhone 13 Pro Max'] as $index => $name) {
            Product::create([
                'name' => $name,
                'slug' => 'iphone-13-'.$index,
                'price' => 5000000,
                'storage' => '128GB',
                'color' => 'Black',
                'stock' => 1,
                'image_url' => '/images/iphone-13-product.png',
                'is_active' => true,
            ]);
        }

        $this->actingAs($admin)
            ->get('/admin/products')
            ->assertOk()
            ->assertSee('iPhone 13')
            ->assertSee('3 model')
            ->assertSee('iPhone 13 Pro Max');
    }

    public function test_product_summary_and_detail_follow_admin_variants(): void
    {
        $admin = User::factory()->create();
        $product = Product::create([
            'name' => 'iPhone 11 Pro',
            'slug' => 'iphone-11-pro-test',
            'price' => 1,
            'storage' => '64GB',
            'color' => 'Black',
            'stock' => 1,
            'image_url' => '/images/iphone-13-product.png',
            'is_active' => true,
        ]);

        $this->actingAs($admin)->put("/admin/products/{$product->slug}", [
            'name' => 'iPhone 11 Pro',
            'is_active' => '1',
            'variants' => [
                ['storage' => '64GB', 'color' => 'Midnight Green', 'price' => 5450000, 'stock' => 4, 'is_active' => '1'],
                ['storage' => '64GB', 'color' => 'Natural Titanium', 'price' => 5450000, 'stock' => 3, 'is_active' => '1'],
                ['storage' => '128GB', 'color' => 'Yellow', 'price' => 6450000, 'stock' => 2, 'is_active' => '1'],
            ],
        ])->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'price' => 5450000,
            'stock' => 9,
        ]);

        $this->get("/produk/{$product->slug}")
            ->assertOk()
            ->assertSee('id="capacityOptions"', false)
            ->assertSee('id="variantStockText"', false)
            ->assertSee('"storage":"128GB"', false)
            ->assertSee('"stock":2', false);
    }

    public function test_admin_can_only_delete_finished_or_cancelled_preorders(): void
    {
        $admin = User::factory()->create();
        $activePreorder = Preorder::create([
            'customer_name' => 'Aktif',
            'whatsapp' => '0812',
            'phone_series' => 'iPhone 15',
            'storage' => '128GB',
            'color' => 'Black',
            'status' => 'diproses',
        ]);
        $finishedPreorder = Preorder::create([
            'customer_name' => 'Selesai',
            'whatsapp' => '0813',
            'phone_series' => 'Samsung S24',
            'storage' => '256GB',
            'color' => 'Blue',
            'status' => 'selesai',
        ]);

        $this->actingAs($admin)
            ->delete("/admin/preorders/{$activePreorder->id}")
            ->assertSessionHas('error');
        $this->assertDatabaseHas('preorders', ['id' => $activePreorder->id]);

        $this->actingAs($admin)
            ->delete("/admin/preorders/{$finishedPreorder->id}")
            ->assertSessionHas('success');
        $this->assertDatabaseMissing('preorders', ['id' => $finishedPreorder->id]);
    }

    public function test_admin_login_is_rate_limited_after_five_attempts(): void
    {
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post('/admin/login', [
                'login' => 'rate-limit-test@example.com',
                'password' => 'password-salah',
            ])->assertStatus(302);
        }

        $this->post('/admin/login', [
            'login' => 'rate-limit-test@example.com',
            'password' => 'password-salah',
        ])->assertStatus(429);
    }

    public function test_admin_can_change_password_from_security_page(): void
    {
        $admin = User::factory()->create(['password' => 'PasswordLama123']);

        $this->actingAs($admin)->put('/admin/profile/password', [
            'current_password' => 'PasswordLama123',
            'password' => 'PasswordBaru456',
            'password_confirmation' => 'PasswordBaru456',
        ])->assertSessionHas('success');

        $this->assertTrue(Hash::check('PasswordBaru456', $admin->fresh()->password));
        $this->assertFalse(Hash::check('PasswordLama123', $admin->fresh()->password));
    }
}
