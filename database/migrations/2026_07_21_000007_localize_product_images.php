<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach ($this->localImages() as $name => $imageUrl) {
            DB::table('products')
                ->where('name', $name)
                ->where(function ($query) {
                    $query->whereNull('image_url')
                        ->orWhere('image_url', 'like', 'https://images.unsplash.com/%');
                })
                ->update(['image_url' => $imageUrl]);
        }
    }

    public function down(): void
    {
        // File lokal tetap valid ketika migration dibatalkan, jadi path tidak perlu dikembalikan ke URL eksternal.
    }

    /**
     * @return array<string, string>
     */
    private function localImages(): array
    {
        return [
            'iPhone X' => '/images/products/iphone-x.jpg',
            'iPhone XR' => '/images/iphone-xr-product-v2.png',
            'iPhone XS' => '/images/products/iphone-xs.jpg',
            'iPhone XS Max' => '/images/products/iphone-xs.jpg',
            'iPhone 11' => '/images/products/iphone-11.jpg',
            'iPhone 11 Pro' => '/images/products/iphone-11-pro.jpg',
            'iPhone 11 Pro Max' => '/images/products/iphone-11-pro.jpg',
            'iPhone 12 mini' => '/images/products/iphone-12.jpg',
            'iPhone 12' => '/images/products/iphone-12.jpg',
            'iPhone 12 Pro' => '/images/products/iphone-12.jpg',
            'iPhone 12 Pro Max' => '/images/products/iphone-12.jpg',
            'iPhone 13 mini' => '/images/iphone-13-product.png',
            'iPhone 13' => '/images/iphone-13-product.png',
            'iPhone 13 Pro' => '/images/iphone-13-pro-product.png',
            'iPhone 13 Pro Max' => '/images/iphone-13-pro-product.png',
            'iPhone 14' => '/images/products/iphone-14.jpg',
            'iPhone 14 Plus' => '/images/products/iphone-14.jpg',
            'iPhone 14 Pro' => '/images/products/iphone-14.jpg',
            'iPhone 14 Pro Max' => '/images/products/iphone-14.jpg',
            'iPhone 15' => '/images/products/iphone-15.jpg',
            'iPhone 15 Plus' => '/images/products/iphone-15.jpg',
            'iPhone 15 Pro' => '/images/products/iphone-15.jpg',
            'iPhone 15 Pro Max' => '/images/products/iphone-15.jpg',
        ];
    }
};
