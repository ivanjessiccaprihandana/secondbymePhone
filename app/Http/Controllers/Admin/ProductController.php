<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Preorder;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('variants')->latest()->get();
        $productGroups = $products
            ->groupBy(fn (Product $product) => $this->productFamily($product->name))
            ->sortKeysUsing(fn (string $first, string $second) => $this->familyRank($second) <=> $this->familyRank($first));
        $stats = [
            'products' => $products->count(),
            'active' => $products->where('is_active', true)->count(),
            'stock' => $products->sum('stock'),
            'new_preorders' => Preorder::where('status', 'baru')->count(),
        ];

        return view('admin.products.index', compact('products', 'productGroups', 'stats'));
    }

    public function create(): View
    {
        return view('admin.products.form', ['product' => new Product, 'variants' => collect()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $first = $validated['variants'][0];
        $product = Product::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']).'-'.Str::lower(Str::random(4)),
            'storage' => $first['storage'],
            'color' => $first['color'],
            'price' => $first['price'],
            'stock' => collect($validated['variants'])->sum('stock'),
            'image_url' => '/images/iphone-13-product.png',
            'is_active' => $request->boolean('is_active'),
        ]);
        $this->syncVariants($product, $validated['variants']);

        return redirect()->route('admin.products.index')->with('success', 'Produk dan variannya berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', ['product' => $product, 'variants' => $product->variants()->get()]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validated($request);
        $first = $validated['variants'][0];
        $product->update([
            'name' => $validated['name'],
            'storage' => $first['storage'],
            'color' => $first['color'],
            'price' => collect($validated['variants'])->min('price'),
            'stock' => collect($validated['variants'])->where('is_active', true)->sum('stock'),
            'is_active' => $request->boolean('is_active'),
        ]);
        $this->syncVariants($product, $validated['variants']);

        return redirect()->route('admin.products.index')->with('success', 'Produk dan stok varian berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'variants' => ['required', 'array', 'min:1', 'max:30'],
            'variants.*.storage' => ['required', 'string', 'max:30'],
            'variants.*.color' => ['required', 'string', 'max:60'],
            'variants.*.price' => ['required', 'integer', 'min:0'],
            'variants.*.stock' => ['required', 'integer', 'min:0'],
            'variants.*.is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function syncVariants(Product $product, array $variants): void
    {
        $product->variants()->delete();
        foreach ($variants as $variant) {
            $product->variants()->create([
                'storage' => $variant['storage'],
                'color' => $variant['color'],
                'price' => $variant['price'],
                'stock' => $variant['stock'],
                'is_active' => (bool) ($variant['is_active'] ?? false),
            ]);
        }
    }

    private function productFamily(string $name): string
    {
        if (preg_match('/iPhone\s+(\d+)/i', $name, $matches)) {
            return 'iPhone '.$matches[1];
        }

        if (preg_match('/iPhone\s+X/i', $name)) {
            return 'iPhone X Series';
        }

        return 'Produk Lainnya';
    }

    private function familyRank(string $family): int
    {
        if (preg_match('/iPhone\s+(\d+)/i', $family, $matches)) {
            return (int) $matches[1];
        }

        return $family === 'iPhone X Series' ? 10 : 0;
    }
}
