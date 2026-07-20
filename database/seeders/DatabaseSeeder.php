<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = config('admin.email');
        $adminPassword = config('admin.password');

        if (! User::where('email', $adminEmail)->exists()) {
            if (app()->isProduction() && blank($adminPassword)) {
                throw new \RuntimeException('ADMIN_PASSWORD wajib diisi sebelum membuat admin production.');
            }

            User::create([
                'name' => 'Admin SecondByMePhone',
                'email' => $adminEmail,
                'password' => $adminPassword ?: 'admin123',
            ]);
        }

        $items = [
            ['iPhone X', '64GB', 'Space Gray', 2850000, 3, 'https://images.unsplash.com/photo-1510166089176-b57564a542b1?auto=format&fit=crop&w=700&q=85'],
            ['iPhone XR', '64GB', 'Coral', 3250000, 4, '/images/iphone-xr-product-v2.png'],
            ['iPhone XS', '64GB', 'Gold', 3550000, 2, 'https://images.unsplash.com/photo-1537589376225-5405c60a5bd8?auto=format&fit=crop&w=700&q=85'],
            ['iPhone XS Max', '256GB', 'Gold', 4650000, 2, 'https://images.unsplash.com/photo-1537589376225-5405c60a5bd8?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 11', '64GB', 'Purple', 4250000, 5, 'https://images.unsplash.com/photo-1592286927505-1def25115558?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 11 Pro', '64GB', 'Midnight Green', 5450000, 3, 'https://images.unsplash.com/photo-1574755393849-623942496936?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 11 Pro Max', '256GB', 'Space Gray', 6850000, 2, 'https://images.unsplash.com/photo-1574755393849-623942496936?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 12 mini', '128GB', 'Blue', 5250000, 2, 'https://images.unsplash.com/photo-1603898037225-1bea09c550c0?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 12', '128GB', 'Blue', 6150000, 3, 'https://images.unsplash.com/photo-1603898037225-1bea09c550c0?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 12 Pro', '128GB', 'Pacific Blue', 7350000, 3, 'https://images.unsplash.com/photo-1603898037225-1bea09c550c0?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 12 Pro Max', '256GB', 'Pacific Blue', 8650000, 2, 'https://images.unsplash.com/photo-1603898037225-1bea09c550c0?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 13 mini', '128GB', 'Pink', 6850000, 2, '/images/iphone-13-product.png'],
            ['iPhone 13', '128GB', 'Midnight', 7850000, 4, '/images/iphone-13-product.png'],
            ['iPhone 13 Pro', '256GB', 'Sierra Blue', 10250000, 2, '/images/iphone-13-pro-product.png'],
            ['iPhone 13 Pro Max', '256GB', 'Sierra Blue', 11450000, 3, '/images/iphone-13-pro-product.png'],
            ['iPhone 14', '128GB', 'Red', 10850000, 2, 'https://images.unsplash.com/photo-1663499482523-1c0c1bae4ce1?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 14 Plus', '128GB', 'Blue', 11950000, 2, 'https://images.unsplash.com/photo-1663499482523-1c0c1bae4ce1?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 14 Pro', '256GB', 'Deep Purple', 14350000, 2, 'https://images.unsplash.com/photo-1663499482523-1c0c1bae4ce1?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 14 Pro Max', '256GB', 'Deep Purple', 15750000, 2, 'https://images.unsplash.com/photo-1663499482523-1c0c1bae4ce1?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 15', '128GB', 'Black', 12750000, 3, 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 15 Plus', '128GB', 'Blue', 14250000, 2, 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 15 Pro', '256GB', 'Natural Titanium', 17250000, 2, 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=700&q=85'],
            ['iPhone 15 Pro Max', '256GB', 'Natural Titanium', 19450000, 2, 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?auto=format&fit=crop&w=700&q=85'],
        ];
        foreach ($items as [$name,$storage,$color,$price,$stock,$image]) {
            Product::updateOrCreate(['slug' => str($name.'-'.$storage)->slug()], compact('name', 'storage', 'color', 'price', 'stock') + ['image_url' => $image, 'is_active' => true]);
        }
    }
}
