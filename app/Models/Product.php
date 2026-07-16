<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'price', 'storage', 'available_storages', 'color', 'available_colors', 'stock', 'image_url', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'price' => 'integer', 'stock' => 'integer', 'available_colors' => 'array', 'available_storages' => 'array'];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->orderBy('storage')->orderBy('color');
    }

    public function colorOptions(): array
    {
        return $this->available_colors ?: [['name' => $this->color, 'hex' => '#64748b']];
    }

    public function storageOptions(): array
    {
        return $this->available_storages ?: [$this->storage];
    }
}
