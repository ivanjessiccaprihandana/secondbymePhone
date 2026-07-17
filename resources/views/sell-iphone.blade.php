<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Jual iPhone — SecondByMePhone</title>@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#f4f3ee] text-[#171816] antialiased">
    <header class="px-4 pt-4">
        <nav class="mx-auto flex h-16 max-w-6xl items-center justify-between rounded-2xl bg-white/80 px-5 shadow-sm"><a
                href="{{ url('/') }}" class="text-lg font-black">secondbyme<span class="text-lime-600">.</span></a><a
                href="{{ url('/#produk') }}" class="text-sm font-bold">← Ready Stock</a></nav>
    </header>
    <main class="mx-auto grid max-w-6xl gap-10 px-5 py-12 lg:grid-cols-[.8fr_1.2fr] lg:py-20">
        <section>
            <p class="text-xs font-black uppercase tracking-[.2em] text-lime-700">Trade your phone</p>
            <h1 class="mt-5 text-5xl font-black leading-[.95] tracking-[-.06em] sm:text-6xl">Jual iPhone tanpa ribet.
            </h1>
            <p class="mt-6 max-w-md leading-7 text-black/50">Ceritakan kondisi iPhone kamu. Data akan dikirim ke admin
                untuk pemeriksaan awal dan penawaran harga.</p>
            <div class="mt-9 space-y-4">
                @foreach ([['1', 'Isi data iPhone', 'Masukkan seri, kapasitas, dan kondisi unit.'], ['2', 'Kirim foto via WhatsApp', 'Admin akan meminta foto untuk verifikasi.'], ['3', 'Dapatkan penawaran', 'Harga final diberikan setelah pengecekan.']] as $step)
                    <div class="flex gap-4 rounded-2xl bg-white p-5"><span
                            class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-[#c8ff46] font-black">{{ $step[0] }}</span>
                        <div>
                            <p class="font-black">{{ $step[1] }}</p>
                            <p class="mt-1 text-sm text-black/45">{{ $step[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="rounded-[2rem] bg-[#171816] p-6 text-white shadow-2xl sm:p-9">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[.2em] text-[#c8ff46]">Form penjualan</p>
                    <h2 class="mt-2 text-2xl font-black">Data iPhone Kamu</h2>
                </div><span class="rounded-full border border-white/15 px-3 py-1 text-[10px] text-white/50">Tanpa
                    login</span>
            </div>
            <form id="sellPhoneForm" class="mt-8 grid gap-5">
                <div><label class="text-xs font-bold text-white/60" for="sellerName">Nama *</label><input
                        id="sellerName" required
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 outline-none focus:border-[#c8ff46]"
                        placeholder="Nama kamu"></div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div><label class="text-xs font-bold text-white/60" for="phoneSeries">Seri iPhone *</label><select
                            id="phoneSeries" required
                            class="mt-2 w-full rounded-xl border border-white/10 bg-[#222320] px-4 py-3.5">
                            <option value="">Pilih seri</option>
                            @foreach (['iPhone X', 'iPhone XR', 'iPhone XS', 'iPhone 11', 'iPhone 11 Pro', 'iPhone 12', 'iPhone 12 Pro', 'iPhone 13', 'iPhone 13 Pro', 'iPhone 14', 'iPhone 14 Pro', 'iPhone 15', 'iPhone 15 Pro'] as $series)
                                <option>{{ $series }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label class="text-xs font-bold text-white/60" for="sellStorage">Kapasitas *</label><select
                            id="sellStorage" required
                            class="mt-2 w-full rounded-xl border border-white/10 bg-[#222320] px-4 py-3.5">
                            <option value="">Pilih kapasitas</option>
                            <option>64GB</option>
                            <option>128GB</option>
                            <option>256GB</option>
                            <option>512GB</option>
                            <option>1TB</option>
                        </select></div>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div><label class="text-xs font-bold text-white/60" for="batteryHealth">Battery Health
                            *</label><input id="batteryHealth" required type="number" min="1" max="100"
                            class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 outline-none focus:border-[#c8ff46]"
                            placeholder="Contoh: 87"></div>
                    <div><label class="text-xs font-bold text-white/60" for="condition">Kondisi fisik *</label><select
                            id="condition" required
                            class="mt-2 w-full rounded-xl border border-white/10 bg-[#222320] px-4 py-3.5">
                            <option value="">Pilih kondisi</option>
                            <option>Mulus seperti baru</option>
                            <option>Ada pemakaian ringan</option>
                            <option>Ada baret/penyok</option>
                            <option>Layar atau backglass retak</option>
                        </select></div>
                </div>
                <div><label class="text-xs font-bold text-white/60">Kelengkapan</label>
                    <div class="mt-2 grid grid-cols-2 gap-3 sm:grid-cols-4">
                        @foreach (['Box', 'Kabel', 'Nota', 'Unit Only'] as $item)
                            <label class="cursor-pointer"><input type="checkbox" name="accessories"
                                    value="{{ $item }}" class="peer sr-only"><span
                                    class="block rounded-xl border border-white/10 p-3 text-center text-xs font-bold peer-checked:border-[#c8ff46] peer-checked:text-[#c8ff46]">{{ $item }}</span></label>
                        @endforeach
                    </div>
                </div>
                <div><label class="text-xs font-bold text-white/60" for="issueNotes">Minus atau catatan</label>
                    <textarea id="issueNotes" rows="3"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 outline-none focus:border-[#c8ff46]"
                        placeholder="Jelaskan riwayat servis, kerusakan, atau minus lainnya"></textarea>
                </div>
                <div><label class="text-xs font-bold text-white/60" for="expectedPrice">Harga yang
                        diharapkan</label><input id="expectedPrice"
                        class="mt-2 w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3.5 outline-none focus:border-[#c8ff46]"
                        placeholder="Contoh: Rp 5.000.000"></div>
                <button class="mt-2 rounded-xl bg-[#c8ff46] px-6 py-4 font-black text-black" type="submit">Minta
                    Penawaran via WhatsApp →</button>
                <p class="text-center text-[11px] text-white/35">Harga final ditentukan setelah pemeriksaan fisik unit.
                </p>
            </form>
        </section>
    </main>
    <footer class="px-5 pb-10 text-center text-xs text-black/40">Jl. Jayaraya, Girimulyo, Nabire, Papua Tengah ·
        0812-2262-1419</footer>
</body>

</html>
