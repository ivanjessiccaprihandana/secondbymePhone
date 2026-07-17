<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')->orderBy('id')->each(function (object $product): void {
            $activeVariants = DB::table('product_variants')
                ->where('product_id', $product->id)
                ->where('is_active', true);
            $firstVariant = (clone $activeVariants)->orderBy('id')->first()
                ?? DB::table('product_variants')->where('product_id', $product->id)->orderBy('id')->first();

            if (! $firstVariant) {
                return;
            }

            DB::table('products')->where('id', $product->id)->update([
                'storage' => $firstVariant->storage,
                'color' => $firstVariant->color,
                'price' => (clone $activeVariants)->min('price') ?? 0,
                'stock' => (clone $activeVariants)->sum('stock'),
                'updated_at' => now(),
            ]);
        });
    }

    public function down(): void
    {
        // Ringkasan lama tidak dapat dipulihkan secara akurat.
    }
};
