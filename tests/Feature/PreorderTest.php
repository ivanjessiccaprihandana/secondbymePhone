<?php

namespace Tests\Feature;

use App\Models\Preorder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
