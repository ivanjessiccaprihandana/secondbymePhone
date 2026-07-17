@extends('layouts.admin')

@section('title', $product->exists ? 'Edit Produk' : 'Tambah Produk')

@php
    $models = [
        'iPhone X',
        'iPhone XR',
        'iPhone XS',
        'iPhone XS Max',
        'iPhone 11',
        'iPhone 11 Pro',
        'iPhone 11 Pro Max',
        'iPhone 12 mini',
        'iPhone 12',
        'iPhone 12 Pro',
        'iPhone 12 Pro Max',
        'iPhone 13 mini',
        'iPhone 13',
        'iPhone 13 Pro',
        'iPhone 13 Pro Max',
        'iPhone 14',
        'iPhone 14 Plus',
        'iPhone 14 Pro',
        'iPhone 14 Pro Max',
        'iPhone 15',
        'iPhone 15 Plus',
        'iPhone 15 Pro',
        'iPhone 15 Pro Max',
    ];

    $storages = ['64GB', '128GB', '256GB', '512GB', '1TB'];
    $colors = [
        'Black',
        'White',
        'Space Gray',
        'Silver',
        'Gold',
        'Midnight',
        'Starlight',
        'Blue',
        'Sierra Blue',
        'Pacific Blue',
        'Purple',
        'Deep Purple',
        'Pink',
        'Red',
        'Green',
        'Yellow',
        'Coral',
        'Midnight Green',
        'Natural Titanium',
        'Blue Titanium',
        'White Titanium',
        'Black Titanium',
    ];

    $savedVariants = $variants
        ->map(
            fn($variant) => [
                'storage' => $variant->storage,
                'color' => $variant->color,
                'price' => $variant->price,
                'stock' => $variant->stock,
                'is_active' => $variant->is_active,
            ],
        )
        ->all();

    $rows = old('variants', $savedVariants);
    if (empty($rows)) {
        $rows = [['storage' => '', 'color' => '', 'price' => '', 'stock' => 0, 'is_active' => true]];
    }
@endphp

@section('content')
    <div class="mx-auto max-w-5xl">
        <a href="{{ route('admin.products.index') }}"
            class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900">← Kembali ke
            produk</a>

        <div class="mt-5 rounded-[2rem] border border-slate-200/70 bg-white p-7 shadow-sm sm:p-10">
            <p class="text-xs font-black uppercase tracking-wider text-lime-700">Produk & Varian</p>
            <h1 class="mt-2 text-3xl font-black">{{ $product->exists ? 'Edit' : 'Tambah' }} Produk</h1>
            <p class="mt-2 text-sm text-slate-400">
                Satu model dapat memiliki banyak kombinasi kapasitas, warna, harga, dan stok.
            </p>

            @if ($errors->any())
                <div class="mt-5 rounded-xl bg-red-50 p-4 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST"
                action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
                class="mt-7">
                @csrf
                @if ($product->exists)
                    @method('PUT')
                @endif

                <label class="block text-sm font-bold">
                    Model iPhone
                    <select name="name" required class="mt-2 w-full rounded-xl border bg-white px-4 py-3">
                        <option value="">Pilih model</option>
                        @foreach ($models as $model)
                            <option value="{{ $model }}" @selected(old('name', $product->name) === $model)>{{ $model }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <div class="mt-8 flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-black">Varian Ready Stock</h2>
                        <p class="mt-1 text-xs text-slate-400">Tambahkan satu baris untuk setiap kombinasi kapasitas dan
                            warna.</p>
                    </div>
                    <button id="addVariant" type="button" class="rounded-xl bg-lime-400 px-4 py-2.5 text-xs font-black">
                        + Tambah Varian
                    </button>
                </div>

                <div id="variantRows" class="mt-4 grid gap-3">
                    @foreach ($rows as $index => $row)
                        <div class="variant-row grid gap-3 rounded-2xl border bg-slate-50 p-4 md:grid-cols-[1fr_1.2fr_1.2fr_.7fr_auto]"
                            data-index="{{ $index }}">
                            <select name="variants[{{ $index }}][storage]" required
                                class="rounded-xl border bg-white px-3 py-3 text-sm">
                                <option value="">Kapasitas</option>
                                @foreach ($storages as $storage)
                                    <option value="{{ $storage }}" @selected(($row['storage'] ?? '') === $storage)>
                                        {{ $storage }}</option>
                                @endforeach
                            </select>

                            <select name="variants[{{ $index }}][color]" required
                                class="rounded-xl border bg-white px-3 py-3 text-sm">
                                <option value="">Warna</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color }}" @selected(($row['color'] ?? '') === $color)>
                                        {{ $color }}</option>
                                @endforeach
                            </select>

                            <input name="variants[{{ $index }}][price]" type="number" min="0"
                                value="{{ $row['price'] ?? '' }}" required placeholder="Harga"
                                class="rounded-xl border px-3 py-3 text-sm">
                            <input name="variants[{{ $index }}][stock]" type="number" min="0"
                                value="{{ $row['stock'] ?? 0 }}" required placeholder="Stok"
                                class="rounded-xl border px-3 py-3 text-sm">

                            <div class="flex items-center gap-2">
                                <input type="hidden" name="variants[{{ $index }}][is_active]" value="0">
                                <label class="flex items-center gap-1 text-xs font-bold">
                                    <input type="checkbox" name="variants[{{ $index }}][is_active]" value="1"
                                        @checked($row['is_active'] ?? true)>
                                    Aktif
                                </label>
                                <button type="button" class="remove-variant rounded-lg bg-red-50 px-2 py-1 text-red-600"
                                    aria-label="Hapus varian">×</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <template id="variantTemplate">
                    <div
                        class="variant-row grid gap-3 rounded-2xl border bg-slate-50 p-4 md:grid-cols-[1fr_1.2fr_1.2fr_.7fr_auto]">
                        <select data-field="storage" required class="rounded-xl border bg-white px-3 py-3 text-sm">
                            <option value="">Kapasitas</option>
                            @foreach ($storages as $storage)
                                <option value="{{ $storage }}">{{ $storage }}</option>
                            @endforeach
                        </select>

                        <select data-field="color" required class="rounded-xl border bg-white px-3 py-3 text-sm">
                            <option value="">Warna</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>

                        <input data-field="price" type="number" min="0" required placeholder="Harga"
                            class="rounded-xl border px-3 py-3 text-sm">
                        <input data-field="stock" type="number" min="0" value="0" required placeholder="Stok"
                            class="rounded-xl border px-3 py-3 text-sm">

                        <div class="flex items-center gap-2">
                            <input data-field="is_active_hidden" type="hidden" value="0">
                            <label class="flex items-center gap-1 text-xs font-bold">
                                <input data-field="is_active" type="checkbox" value="1" checked>
                                Aktif
                            </label>
                            <button type="button" class="remove-variant rounded-lg bg-red-50 px-2 py-1 text-red-600"
                                aria-label="Hapus varian">×</button>
                        </div>
                    </div>
                </template>

                <label class="mt-6 flex items-center gap-3 rounded-xl bg-slate-50 p-4 text-sm font-bold">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->exists ? $product->is_active : true))>
                    Tampilkan produk di website
                </label>

                <button class="mt-5 w-full rounded-xl bg-[#171816] py-4 font-black text-white">
                    Simpan Produk & Varian
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin-products.js'])
@endpush
