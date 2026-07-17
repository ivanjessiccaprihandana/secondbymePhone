<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('storage', 30);
            $table->string('color', 60);
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('stock')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['product_id', 'storage', 'color']);
        });

        foreach (DB::table('products')->get() as $product) {
            DB::table('product_variants')->insert([
                'product_id' => $product->id, 'storage' => $product->storage, 'color' => $product->color,
                'price' => $product->price, 'stock' => $product->stock, 'is_active' => $product->is_active,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
