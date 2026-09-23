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
            ['iPhone X', '64GB', 'Space Gray', 2850000, 3, '/images/products/iphone-x.jpg'],
            ['iPhone XR', '64GB', 'Coral', 3250000, 4, '/images/iphone-xr-product-v2.png'],
            ['iPhone XS', '64GB', 'Gold', 3550000, 2, '/images/products/iphone-xs.jpg'],
            ['iPhone XS Max', '256GB', 'Gold', 4650000, 2, '/images/products/iphone-xs.jpg'],
            ['iPhone 11', '64GB', 'Purple', 4250000, 5, '/images/products/iphone-11.jpg'],
            ['iPhone 11 Pro', '64GB', 'Midnight Green', 5450000, 3, '/images/products/iphone-11-pro.jpg'],
            ['iPhone 11 Pro Max', '256GB', 'Space Gray', 6850000, 2, '/images/products/iphone-11-pro.jpg'],
            ['iPhone 12 mini', '128GB', 'Blue', 5250000, 2, '/images/products/iphone-12.jpg'],
            ['iPhone 12', '128GB', 'Blue', 6150000, 3, '/images/products/iphone-12.jpg'],
            ['iPhone 12 Pro', '128GB', 'Pacific Blue', 7350000, 3, '/images/products/iphone-12.jpg'],
            ['iPhone 12 Pro Max', '256GB', 'Pacific Blue', 8650000, 2, '/images/products/iphone-12.jpg'],
            ['iPhone 13 mini', '128GB', 'Pink', 6850000, 2, '/images/iphone-13-product.png'],
            ['iPhone 13', '128GB', 'Midnight', 7850000, 4, '/images/iphone-13-product.png'],
            ['iPhone 13 Pro', '256GB', 'Sierra Blue', 10250000, 2, '/images/iphone-13-pro-product.png'],
            ['iPhone 13 Pro Max', '256GB', 'Sierra Blue', 11450000, 3, '/images/iphone-13-pro-product.png'],
            ['iPhone 14', '128GB', 'Red', 10850000, 2, '/images/products/iphone-14.jpg'],
            ['iPhone 14 Plus', '128GB', 'Blue', 11950000, 2, '/images/products/iphone-14.jpg'],
            ['iPhone 14 Pro', '256GB', 'Deep Purple', 14350000, 2, '/images/products/iphone-14.jpg'],
            ['iPhone 14 Pro Max', '256GB', 'Deep Purple', 15750000, 2, '/images/products/iphone-14.jpg'],
            ['iPhone 15', '128GB', 'Black', 12750000, 3, '/images/products/iphone-15.jpg'],
            ['iPhone 15 Plus', '128GB', 'Blue', 14250000, 2, '/images/products/iphone-15.jpg'],
            ['iPhone 15 Pro', '256GB', 'Natural Titanium', 17250000, 2, '/images/products/iphone-15.jpg'],
            ['iPhone 15 Pro Max', '256GB', 'Natural Titanium', 19450000, 2, '/images/products/iphone-15.jpg'],
        ];
        foreach ($items as [$name, $storage, $color, $price, $stock, $image]) {
            $product = Product::firstOrCreate(
                ['slug' => str($name.'-'.$storage)->slug()],
                compact('name', 'storage', 'color', 'price', 'stock') + [
                    'image_url' => $image,
                    'is_active' => true,
                ],
            );

            $product->variants()->firstOrCreate(
                compact('storage', 'color'),
                compact('price', 'stock') + ['is_active' => true],
            );
        }
    }
}
