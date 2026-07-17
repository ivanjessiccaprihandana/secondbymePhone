@extends('layouts.admin')

@section('title', 'Produk & Stok')

@section('content')
    <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
        <div>
            <p class="text-sm font-black text-lime-700">Katalog toko</p>
            <h1 class="mt-1 text-3xl font-black tracking-[-.04em] sm:text-4xl">Produk & Stok</h1>
            <p class="mt-2 text-sm text-slate-500">Atur model, varian, harga, dan ketersediaan iPhone.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#171816] px-5 py-3.5 text-sm font-black text-white shadow-lg shadow-black/10 transition hover:-translate-y-0.5">
            <span class="text-lg leading-none text-[#c8ff46]">+</span> Tambah Produk
        </a>
    </div>

    <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([['label' => 'Total Produk', 'value' => $stats['products'], 'caption' => 'model terdaftar', 'color' => 'bg-blue-50 text-blue-700'], ['label' => 'Produk Aktif', 'value' => $stats['active'], 'caption' => 'tampil di website', 'color' => 'bg-emerald-50 text-emerald-700'], ['label' => 'Total Stok', 'value' => $stats['stock'], 'caption' => 'unit tersedia', 'color' => 'bg-violet-50 text-violet-700'], ['label' => 'Preorder Baru', 'value' => $stats['new_preorders'], 'caption' => 'perlu ditindaklanjuti', 'color' => 'bg-amber-50 text-amber-700']] as $card)
            <article class="rounded-2xl border border-slate-200/70 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $card['label'] }}</p>
                        <p class="mt-3 text-3xl font-black tracking-[-.04em]">{{ $card['value'] }}</p>
                        <p class="mt-1 text-xs text-slate-400">{{ $card['caption'] }}</p>
                    </div>
                    <span class="grid h-10 w-10 place-items-center rounded-xl {{ $card['color'] }}">●</span>
                </div>
            </article>
        @endforeach
    </section>

    <section class="mt-8">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h2 class="font-black">Produk per Generasi</h2>
                <p class="mt-0.5 text-xs text-slate-400">Klik generasi untuk melihat semua model di dalamnya.</p>
            </div>
            <span
                class="rounded-full bg-white px-3 py-1 text-xs font-bold text-slate-500 shadow-sm">{{ $products->count() }}
                produk</span>
        </div>

        <div class="grid gap-4">
            @forelse ($productGroups as $family => $groupProducts)
                @php
                    $variantCount = $groupProducts->sum(fn($product) => $product->variants->count());
                    $stockCount = $groupProducts->sum('stock');
                @endphp
                <details class="group overflow-hidden rounded-2xl border border-slate-200/70 bg-white shadow-sm"
                    @if ($loop->first) open @endif>
                    <summary
                        class="flex cursor-pointer list-none items-center justify-between gap-4 px-5 py-5 transition hover:bg-slate-50 [&::-webkit-details-marker]:hidden">
                        <div class="flex min-w-0 items-center gap-4">
                            <span
                                class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#171816] text-sm font-black text-[#c8ff46]">
                                {{ str_replace(['iPhone ', ' Series'], '', $family) }}
                            </span>
                            <div class="min-w-0">
                                <h3 class="text-lg font-black">{{ $family }}</h3>
                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $groupProducts->count() }} model · {{ $variantCount }} varian · {{ $stockCount }}
                                    unit stok
                                </p>
                            </div>
                        </div>
                        <span
                            class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-slate-100 text-lg font-bold text-slate-500 transition group-open:rotate-180">⌄</span>
                    </summary>

                    <div class="border-t border-slate-100">
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[860px] text-left">
                                <thead
                                    class="bg-slate-50/80 text-[11px] font-black uppercase tracking-wider text-slate-400">
                                    <tr>
                                        <th class="px-5 py-3">Model</th>
                                        <th class="px-4 py-3">Harga mulai</th>
                                        <th class="px-4 py-3">Varian</th>
                                        <th class="px-4 py-3">Stok</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-5 py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach ($groupProducts->sortBy('name', SORT_NATURAL) as $product)
                                        <tr class="transition hover:bg-slate-50/70">
                                            <td class="px-5 py-4">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                        class="h-14 w-14 rounded-xl bg-slate-100 object-cover">
                                                    <div>
                                                        <p class="font-black">{{ $product->name }}</p>
                                                        <p class="mt-1 text-xs text-slate-400">{{ $product->storage }} ·
                                                            {{ $product->color }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 font-black">Rp
                                                {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-4 text-sm font-bold text-slate-500">
                                                {{ $product->variants->count() }} pilihan</td>
                                            <td class="px-4 py-4">
                                                <span
                                                    class="rounded-full px-2.5 py-1 text-xs font-black {{ $product->stock ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600' }}">{{ $product->stock }}
                                                    unit</span>
                                            </td>
                                            <td class="px-4 py-4">
                                                <span
                                                    class="inline-flex items-center gap-1.5 text-xs font-bold {{ $product->is_active ? 'text-emerald-700' : 'text-slate-400' }}">
                                                    <span
                                                        class="h-2 w-2 rounded-full {{ $product->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                                    {{ $product->is_active ? 'Tampil' : 'Disembunyikan' }}
                                                </span>
                                            </td>
                                            <td class="px-5 py-4">
                                                <div class="flex justify-end gap-2">
                                                    <a href="{{ route('admin.products.edit', $product) }}"
                                                        class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-black text-slate-700 transition hover:bg-slate-200">Edit</a>
                                                    <form method="POST"
                                                        action="{{ route('admin.products.destroy', $product) }}"
                                                        onsubmit="return confirm('Hapus produk ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="rounded-lg bg-red-50 px-3 py-2 text-xs font-black text-red-600 transition hover:bg-red-100">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </details>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white/60 p-14 text-center">
                    <p class="font-black text-slate-600">Belum ada produk.</p>
                    <p class="mt-1 text-sm text-slate-400">Tambahkan produk pertama untuk mengisi katalog.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
