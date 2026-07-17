@php
    $steps = [
        ['number' => '1', 'title' => 'Isi permintaan', 'description' => 'Masukkan merek/seri, kapasitas, dan warna.'],
        ['number' => '2', 'title' => 'Kirim ke WhatsApp', 'description' => 'Data preorder dirangkum otomatis.'],
        [
            'number' => '3',
            'title' => 'Tunggu konfirmasi',
            'description' => 'Admin mengabarkan ketersediaan dan estimasi.',
        ],
    ];

    $phoneSuggestions = [
        'iPhone 15 Pro Max',
        'Samsung Galaxy S24 Ultra',
        'Samsung Galaxy A55',
        'Google Pixel 8 Pro',
        'Xiaomi 14',
        'Redmi Note 13 Pro',
        'OPPO Reno 11',
        'vivo V30',
        'realme 12 Pro',
    ];

    $colorSuggestions = [
        'Hitam',
        'Putih',
        'Abu-abu',
        'Silver',
        'Gold',
        'Biru',
        'Hijau',
        'Ungu',
        'Merah',
        'Pink',
        'Kuning',
        'Cream',
    ];
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Form preorder HP iPhone dan Android SecondByMePhone">
    <title>Preorder HP — SecondByMePhone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f4f3ee] text-[#171816] antialiased">
    <header class="px-4 pt-4">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between rounded-2xl bg-white/80 px-5 shadow-sm">
            <a href="{{ url('/') }}" class="text-lg font-black">
                secondbyme<span class="text-lime-600">.</span>
            </a>
            <a href="{{ url('/#produk') }}" class="text-sm font-bold">← Ready Stock</a>
        </nav>
    </header>

    <main class="mx-auto grid max-w-6xl gap-10 px-5 py-12 lg:grid-cols-[.8fr_1.2fr] lg:py-20">
        <section>
            <p class="text-xs font-black uppercase tracking-[.2em] text-lime-700">Request your phone</p>
            <h1 class="mt-5 text-5xl font-black leading-[.95] tracking-[-.06em] sm:text-6xl">
                Preorder HP yang kamu mau.
            </h1>
            <p class="mt-6 max-w-md leading-7 text-black/50">
                Cari iPhone atau Android tertentu? Kirim detail HP yang kamu inginkan dan admin akan membantu
                mencarikannya.
            </p>

            <div class="mt-9 space-y-4">
                @foreach ($steps as $step)
                    <div class="flex gap-4 rounded-2xl bg-white p-5">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[#c8ff46] font-black">
                            {{ $step['number'] }}
                        </span>
                        <div>
                            <p class="font-black">{{ $step['title'] }}</p>
                            <p class="mt-1 text-sm text-black/45">{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-[2rem] bg-[#171816] p-6 text-white shadow-2xl sm:p-9">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-black uppercase tracking-[.2em] text-[#c8ff46]">Form preorder</p>
                    <h2 class="mt-2 text-2xl font-black">HP Pilihanmu</h2>
                </div>
                <span class="rounded-full border border-white/15 px-3 py-1 text-[10px] text-white/50">iPhone &
                    Android</span>
            </div>

            @if ($errors->any())
                <div class="mt-6 rounded-xl bg-red-500/15 p-4 text-sm font-bold text-red-300">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('preorder.store') }}" class="mt-8 grid gap-5">
                @csrf

                <label class="text-xs font-bold text-white/60">
                    Nama pemesan *
                    <input name="customer_name" value="{{ old('customer_name') }}" required
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 text-base text-white outline-none focus:border-[#c8ff46]"
                        placeholder="Nama kamu">
                </label>

                <label class="text-xs font-bold text-white/60">
                    Nomor WhatsApp *
                    <input name="whatsapp" value="{{ old('whatsapp') }}" inputmode="tel" required
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 text-base text-white outline-none focus:border-[#c8ff46]"
                        placeholder="Contoh: 081234567890">
                </label>

                <label class="text-xs font-bold text-white/60">
                    Merek dan seri HP *
                    <input name="phone_series" value="{{ old('phone_series') }}" list="phoneSuggestions" required
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 text-base text-white outline-none focus:border-[#c8ff46]"
                        placeholder="Contoh: Samsung Galaxy S24 atau iPhone 15">
                    <datalist id="phoneSuggestions">
                        @foreach ($phoneSuggestions as $series)
                            <option value="{{ $series }}"></option>
                        @endforeach
                    </datalist>
                </label>

                <div class="grid gap-5 sm:grid-cols-2">
                    <label class="text-xs font-bold text-white/60">
                        Kapasitas *
                        <input name="storage" value="{{ old('storage') }}" required
                            class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 text-base text-white outline-none focus:border-[#c8ff46]"
                            placeholder="Contoh: 8/256GB atau 128GB">
                    </label>

                    <label class="text-xs font-bold text-white/60">
                        Warna *
                        <input name="color" value="{{ old('color') }}" list="colorSuggestions" required
                            class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 text-base text-white outline-none focus:border-[#c8ff46]"
                            placeholder="Contoh: Hitam">
                        <datalist id="colorSuggestions">
                            @foreach ($colorSuggestions as $color)
                                <option value="{{ $color }}"></option>
                            @endforeach
                        </datalist>
                    </label>
                </div>

                <label class="text-xs font-bold text-white/60">
                    Catatan
                    <textarea name="notes" rows="4"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 text-base text-white outline-none focus:border-[#c8ff46]"
                        placeholder="Catatan atau permintaan tambahan">{{ old('notes') }}</textarea>
                </label>

                <button class="rounded-xl bg-[#c8ff46] px-6 py-4 font-black text-black" type="submit">
                    Simpan & Kirim ke WhatsApp →
                </button>
                <p class="text-center text-[11px] text-white/35">Permintaan tersimpan dan dapat dipantau admin.</p>
            </form>
        </section>
    </main>

    <footer class="px-5 pb-10 text-center text-xs text-black/40">
        Jl. Jayaraya, Girimulyo, Nabire, Papua Tengah · 0812-2262-1419
    </footer>
</body>

</html>
