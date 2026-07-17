<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PreorderController as AdminPreorderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\PreorderController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome', [
    'products' => Product::query()->where('is_active', true)->where('stock', '>', 0)->orderBy('name')->get(),
]));

Route::view('/jual-iphone', 'sell-iphone')->name('sell-iphone');
Route::view('/preorder', 'preorder')->name('preorder');
Route::post('/preorder', [PreorderController::class, 'store'])->name('preorder.store');

Route::get('/admin', function () {
    return auth()->check()
        ? redirect()->route('admin.products.index')
        : redirect()->route('admin.login');
})->name('admin.home');

Route::get('/produk/{product:slug}', function (Product $product) {
    abort_unless($product->is_active && $product->stock > 0, 404);
    $product->load('images', 'variants');

    return view('product-detail', [
        'product' => $product,
        'related' => Product::where('is_active', true)->where('stock', '>', 0)->whereKeyNot($product->id)->take(4)->get(),
    ]);
})->name('products.show');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.store');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('products', ProductController::class)->except('show');
    Route::get('/preorders', [AdminPreorderController::class, 'index'])->name('preorders.index');
    Route::patch('/preorders/{preorder}', [AdminPreorderController::class, 'update'])->name('preorders.update');
});
