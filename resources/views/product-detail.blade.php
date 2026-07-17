<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product['name'] }} — SecondByMePhone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 antialiased">
    <header class="sticky top-0 z-50 border-b border-slate-100 bg-white/95 backdrop-blur">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 lg:px-8"><a href="{{ url('/') }}"
                class="flex items-center gap-2.5"><span
                    class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-blue-600 to-indigo-800 text-white"><svg
                        class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <rect x="6.5" y="2.5" width="11" height="19" rx="2.5" stroke-width="1.8" />
                        <path d="M10 5h4M10.5 18.5h3" stroke-width="1.8" stroke-linecap="round" />
                    </svg></span><span class="text-lg font-black">second<span
                        class="text-blue-600">byme</span></span></a><a href="{{ url('/#produk') }}"
                class="text-sm font-bold text-slate-600 hover:text-blue-600">← Kembali ke Produk</a></nav>
    </header>

    <main class="mx-auto max-w-7xl px-5 py-8 lg:px-8 lg:py-12">
        <div class="mb-7 flex items-center gap-2 text-xs font-medium text-slate-400"><a
                href="{{ url('/') }}">Home</a><span>/</span><a
                href="{{ url('/#produk') }}">Produk</a><span>/</span><span
                class="text-slate-700">{{ $product['name'] }}</span></div>
        <section class="grid gap-10 lg:grid-cols-[1.05fr_.95fr]">
            <div>
                <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white"><span
                        class="absolute left-5 top-5 z-10 rounded-full bg-emerald-500 px-3 py-1.5 text-xs font-bold text-white">Stok
                        {{ $product->stock }}</span><img id="mainImage"
                        class="aspect-square w-full object-cover transition-opacity duration-200"
                        src="{{ $product->image_url }}" alt="{{ $product->name }}"></div>
                @if ($product->images->isNotEmpty())
                    <div class="mt-4 grid grid-cols-4 gap-3"><button
                            class="gallery-thumb overflow-hidden rounded-xl border-2 border-blue-600 bg-white"
                            data-image="{{ $product->image_url }}"><img class="aspect-square w-full object-cover"
                                src="{{ $product->image_url }}" alt="Foto utama"></button>
                        @foreach ($product->images->take(3) as $image)
                            <button
                                class="gallery-thumb overflow-hidden rounded-xl border-2 border-transparent bg-white"
                                data-image="{{ $image->url }}"><img class="aspect-square w-full object-cover"
                                    src="{{ $image->url }}" alt="Foto detail {{ $loop->iteration }}"></button>
                        @endforeach
                    </div>
                @endif
                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border bg-white p-4">
                        <p class="text-xs font-black text-blue-700">✓ 30+ Checkpoint</p>
                        <p class="mt-1 text-[10px] text-slate-400">Unit sudah diperiksa</p>
                    </div>
                    <div class="rounded-2xl border bg-white p-4">
                        <p class="text-xs font-black text-violet-700">✓ Garansi 12 Bulan</p>
                        <p class="mt-1 text-[10px] text-slate-400">Garansi toko</p>
                    </div><a
                        href="https://wa.me/6281222621419?text={{ urlencode('Halo, boleh kirim foto asli unit ' . $product->name . '?') }}"
                        target="_blank" class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                        <p class="text-xs font-black text-emerald-800">Minta Foto Asli →</p>
                        <p class="mt-1 text-[10px] text-emerald-600">Via WhatsApp</p>
                    </a>
                </div>
            </div>
            <div class="lg:sticky lg:top-24 lg:self-start">
                <div class="flex items-center gap-2"><span
                        class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">SecondByMe
                        Official</span><span class="text-xs text-amber-500">★★★★★ <b class="text-slate-500">4.9 (28
                            ulasan)</b></span></div>
                <h1 class="mt-4 text-3xl font-black leading-tight tracking-tight sm:text-4xl">{{ $product->name }}
                    Second Original Bergaransi</h1>
                <p class="mt-4 text-3xl font-black text-blue-700">Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <div class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 p-5">
                    <p class="font-bold text-amber-950">Kenapa pilih unit ini?</p>
                    <ul class="mt-3 grid gap-2 text-sm text-amber-900">
                        <li>✓ IMEI permanen dan unit original</li>
                        <li>✓ Garansi toko 12 bulan</li>
                        <li>✓ Gratis pengecekan dan konsultasi</li>
                        <li>✓ Siap kirim dengan packing berlapis</li>
                    </ul>
                </div>
                <div class="mt-7">
                    <p class="text-sm font-bold">1. Pilih warna <span id="selectedColor"
                            class="font-medium text-slate-400">— {{ $product->color }}</span></p>
                    <div class="mt-3 flex flex-wrap gap-3">
                        @foreach ($product->colorOptions() as $option)
                            <button type="button" data-color="{{ $option['name'] }}" title="{{ $option['name'] }}"
                                style="background-color: {{ $option['hex'] }}"
                                class="color-option h-10 w-10 rounded-full border-4 border-white shadow ring-1 ring-slate-200 transition hover:scale-110"
                                aria-label="{{ $option['name'] }}"></button>
                        @endforeach
                    </div>
                </div>
                <div class="mt-7">
                    <p class="text-sm font-bold">2. Pilih kapasitas</p>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($product->storageOptions() as $capacity)
                            <button type="button" data-capacity="{{ $capacity }}"
                                class="capacity-option rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold transition hover:border-blue-600 hover:text-blue-600">{{ $capacity }}</button>
                        @endforeach
                    </div>
                </div>
                <div class="mt-7">
                    <p class="text-sm font-bold">3. Tentukan jumlah</p>
                    <div class="mt-3 inline-flex items-center rounded-xl border border-slate-200 bg-white p-1"><button
                            id="minusQty"
                            class="grid h-9 w-9 place-items-center rounded-lg hover:bg-slate-100">−</button><span
                            id="quantity" class="w-10 text-center text-sm font-bold">1</span><button id="plusQty"
                            class="grid h-9 w-9 place-items-center rounded-lg hover:bg-slate-100">+</button></div>
                </div>
                <button id="orderButton" data-name="{{ $product['name'] }}" data-price="{{ $product['price'] }}"
                    data-wa="6281234567890"
                    class="mt-8 flex w-full items-center justify-center gap-3 rounded-2xl bg-[#25D366] px-6 py-4 font-black text-white shadow-lg shadow-emerald-500/20 transition hover:-translate-y-0.5 hover:bg-[#20bd5a]"><svg
                        class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12.04 2a9.84 9.84 0 0 0-8.4 14.96L2 22l5.2-1.62A9.98 9.98 0 1 0 12.04 2Zm5.78 14.1c-.24.68-1.4 1.3-1.94 1.38-.5.1-1.14.14-1.84-.08-.42-.14-.96-.32-1.66-.62-2.92-1.26-4.82-4.2-4.96-4.4-.14-.2-1.18-1.56-1.18-2.98s.74-2.12 1-2.42c.26-.28.56-.36.76-.36h.54c.18 0 .4-.06.62.48.24.58.82 2 .9 2.14.08.14.12.3.02.5-.08.2-.14.32-.28.48-.14.16-.3.36-.42.48-.14.14-.28.28-.12.56.16.28.7 1.16 1.5 1.88 1.04.92 1.9 1.2 2.18 1.34.28.14.44.12.6-.08.18-.2.76-.88.96-1.18.2-.28.4-.24.68-.14.28.1 1.76.84 2.06.98.3.16.5.22.58.34.08.12.08.7-.16 1.4Z" />
                    </svg>Pesan Sekarang via WhatsApp</button>
                <p id="selectionWarning" class="mt-3 hidden text-center text-xs font-semibold text-red-500">Pilih
                    warna dan kapasitas terlebih dahulu.</p>
            </div>
        </section>

        <section class="mt-20 border-t border-slate-200 pt-14">
            <h2 class="text-2xl font-black">Detail & kondisi unit</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([['Battery Health', '85–100%'], ['Kondisi Fisik', 'Grade A'], ['Garansi', '12 Bulan'], ['Kelengkapan', 'Unit + Kabel']] as $detail)
                    <div class="rounded-2xl border border-slate-200 bg-white p-5">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ $detail[0] }}</p>
                        <p class="mt-2 font-black">{{ $detail[1] }}</p>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="mt-20">
            <h2 class="text-2xl font-black">Kamu mungkin juga suka</h2>
            <div class="mt-7 grid grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($related as $item)
                    <a href="{{ route('products.show', $item) }}"
                        class="group overflow-hidden rounded-2xl border border-slate-200 bg-white p-3 transition hover:-translate-y-1 hover:shadow-xl"><img
                            class="aspect-square w-full rounded-xl object-cover" src="{{ $item->image_url }}"
                            alt="{{ $item->name }}">
                        <h3 class="mt-4 text-sm font-bold">{{ $item->name }}</h3>
                        <p class="mt-1 text-sm font-black text-blue-700">Rp
                            {{ number_format($item->price, 0, ',', '.') }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    </main>
    <footer class="mt-20 bg-slate-950 py-10 text-center text-sm text-slate-400">© {{ date('Y') }} SecondByMePhone.
        Unit berkualitas, transaksi lebih aman.</footer>
    <script>
        window.productVariants = @json($product->variants->where('is_active', true)->values());
    </script>
</body>

</html>
