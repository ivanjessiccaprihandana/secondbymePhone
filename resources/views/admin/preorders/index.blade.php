@extends('layouts.admin')

@section('title', 'Pesanan Preorder')

@section('content')
    <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
        <div>
            <p class="text-sm font-black text-lime-700">Permintaan pelanggan</p>
            <h1 class="mt-1 text-3xl font-black tracking-[-.04em] sm:text-4xl">Pesanan Preorder</h1>
            <p class="mt-2 text-sm text-slate-500">Pantau dan tindak lanjuti permintaan HP Android maupun iPhone.</p>
        </div>
        <form method="GET">
            <label class="sr-only" for="statusFilter">Filter status</label>
            <select id="statusFilter" name="status" onchange="this.form.submit()"
                class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold shadow-sm sm:w-auto">
                <option value="">Semua status</option>
                @foreach (\App\Models\Preorder::STATUSES as $key => $label)
                    <option value="{{ $key }}" @selected($status === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <section class="mt-8 grid grid-cols-2 gap-3 lg:grid-cols-5">
        @foreach (\App\Models\Preorder::STATUSES as $key => $label)
            <a href="{{ route('admin.preorders.index', ['status' => $key]) }}"
                class="rounded-2xl border p-4 transition {{ $status === $key ? 'border-[#171816] bg-[#171816] text-white shadow-lg' : 'border-slate-200/70 bg-white hover:-translate-y-0.5 hover:shadow-sm' }}">
                <p class="text-xs font-bold {{ $status === $key ? 'text-white/50' : 'text-slate-400' }}">{{ $label }}
                </p>
                <p class="mt-2 text-2xl font-black">{{ $statusCounts[$key] ?? 0 }}</p>
            </a>
        @endforeach
    </section>

    <section class="mt-8">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="font-black">Daftar Permintaan</h2>
            <span
                class="rounded-full bg-white px-3 py-1 text-xs font-bold text-slate-500 shadow-sm">{{ $preorders->total() }}
                data</span>
        </div>

        <div class="grid gap-4">
            @forelse ($preorders as $preorder)
                @php
                    $statusStyles = [
                        'baru' => 'bg-blue-50 text-blue-700',
                        'diproses' => 'bg-amber-50 text-amber-700',
                        'tersedia' => 'bg-violet-50 text-violet-700',
                        'selesai' => 'bg-emerald-50 text-emerald-700',
                        'dibatalkan' => 'bg-red-50 text-red-600',
                    ];
                @endphp
                <article class="rounded-2xl border border-slate-200/70 bg-white p-5 shadow-sm transition hover:shadow-md">
                    <div class="flex flex-col justify-between gap-6 xl:flex-row">
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span
                                    class="rounded-lg bg-[#171816] px-2.5 py-1 text-xs font-black text-[#c8ff46]">#{{ $preorder->id }}</span>
                                <h2 class="text-lg font-black">{{ $preorder->phone_series }}</h2>
                                <span
                                    class="rounded-full px-2.5 py-1 text-[11px] font-black {{ $statusStyles[$preorder->status] ?? 'bg-slate-100 text-slate-600' }}">
                                    {{ \App\Models\Preorder::STATUSES[$preorder->status] ?? $preorder->status }}
                                </span>
                                <span
                                    class="text-xs text-slate-400">{{ $preorder->created_at->format('d M Y, H:i') }}</span>
                            </div>

                            <div class="mt-5 grid gap-4 text-sm sm:grid-cols-2 lg:grid-cols-4">
                                <div>
                                    <p class="text-xs text-slate-400">Pelanggan</p>
                                    <p class="mt-1 font-black">{{ $preorder->customer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Kapasitas</p>
                                    <p class="mt-1 font-black">{{ $preorder->storage }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Warna</p>
                                    <p class="mt-1 font-black">{{ $preorder->color }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">WhatsApp</p>
                                    <a href="https://wa.me/{{ $preorder->whatsapp }}" target="_blank"
                                        class="mt-1 inline-flex items-center gap-1.5 font-black text-emerald-600 hover:underline">{{ $preorder->whatsapp }}
                                        ↗</a>
                                </div>
                            </div>

                            @if ($preorder->notes)
                                <div class="mt-5 rounded-xl bg-slate-50 px-4 py-3 text-sm text-slate-600"><span
                                        class="font-black text-slate-800">Catatan:</span> {{ $preorder->notes }}</div>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('admin.preorders.update', $preorder) }}"
                            class="flex shrink-0 items-end gap-2 border-t border-slate-100 pt-4 xl:border-l xl:border-t-0 xl:pl-6 xl:pt-0">
                            @csrf
                            @method('PATCH')
                            <label class="flex-1 text-xs font-bold text-slate-400 xl:flex-none">
                                Ubah status
                                <select name="status"
                                    class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm font-bold text-slate-900 xl:w-44">
                                    @foreach (\App\Models\Preorder::STATUSES as $key => $label)
                                        <option value="{{ $key }}" @selected($preorder->status === $key)>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <button
                                class="rounded-xl bg-[#171816] px-4 py-2.5 text-sm font-black text-white">Simpan</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white/60 p-14 text-center">
                    <p class="font-black text-slate-600">Belum ada preorder pada status ini.</p>
                    <p class="mt-1 text-sm text-slate-400">Permintaan pelanggan akan tampil otomatis di sini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-7">{{ $preorders->links() }}</div>
    </section>
@endsection
