<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') — SecondByMePhone Admin</title>
    @vite(['resources/css/app.css'])
    @stack('head')
</head>

<body class="min-h-screen bg-[#f3f4ef] text-slate-900 antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-[270px_1fr]">
        <aside
            class="border-b border-white/10 bg-[#151714] text-white lg:sticky lg:top-0 lg:h-screen lg:border-b-0 lg:border-r">
            <div class="flex items-center justify-between px-5 py-5 lg:px-7 lg:py-8">
                <a href="{{ route('admin.products.index') }}" class="text-xl font-black tracking-[-.05em]">
                    secondbyme<span class="text-[#c8ff46]">.</span>
                </a>
                <span
                    class="rounded-full border border-white/10 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-white/45">Admin</span>
            </div>

            <nav class="flex gap-2 overflow-x-auto px-4 pb-4 lg:block lg:space-y-2 lg:px-5">
                <a href="{{ route('admin.products.index') }}"
                    class="flex shrink-0 items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.products.*') ? 'bg-[#c8ff46] text-black' : 'text-white/55 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Z" />
                        <path d="m4.5 7.5 7.5 4 7.5-4M12 12v9" />
                    </svg>
                    Produk & Stok
                </a>
                <a href="{{ route('admin.preorders.index') }}"
                    class="flex shrink-0 items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.preorders.*') ? 'bg-[#c8ff46] text-black' : 'text-white/55 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M6 3h12l1 18H5L6 3Z" />
                        <path d="M9 8a3 3 0 0 0 6 0" />
                    </svg>
                    Pesanan Preorder
                </a>
                <a href="{{ route('admin.profile.edit') }}"
                    class="flex shrink-0 items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold transition {{ request()->routeIs('admin.profile.*') ? 'bg-[#c8ff46] text-black' : 'text-white/55 hover:bg-white/5 hover:text-white' }}">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21a8 8 0 0 1 16 0" />
                    </svg>
                    Keamanan Akun
                </a>
            </nav>

            <div class="hidden px-5 lg:absolute lg:inset-x-0 lg:bottom-6 lg:block">
                <a href="{{ url('/') }}" target="_blank"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold text-white/55 transition hover:bg-white/5 hover:text-white">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M14 3h7v7M10 14 21 3M21 14v6a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h6" />
                    </svg>
                    Lihat Website
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button
                        class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-bold text-red-300 transition hover:bg-red-500/10">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M10 17l5-5-5-5M15 12H3M15 3h5a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-5" />
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="min-w-0">
            <header class="border-b border-slate-200/70 bg-white/75 px-5 py-4 backdrop-blur lg:px-8">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[.16em] text-lime-700">SecondByMePhone</p>
                        <p class="mt-0.5 text-sm text-slate-400">Kelola toko dengan mudah</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ url('/') }}" target="_blank"
                            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-600 lg:hidden">Website</a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="lg:hidden">
                            @csrf
                            <button
                                class="rounded-xl bg-red-50 px-3 py-2 text-xs font-bold text-red-600">Keluar</button>
                        </form>
                        <div
                            class="grid h-10 w-10 place-items-center rounded-full bg-[#171816] text-sm font-black text-[#c8ff46]">
                            A</div>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-5 py-8 lg:px-8 lg:py-10">
                @if (session('success'))
                    <div
                        class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-700">
                        <span class="grid h-7 w-7 place-items-center rounded-full bg-emerald-500 text-white">✓</span>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="mb-6 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-700">
                        <span class="grid h-7 w-7 place-items-center rounded-full bg-red-500 text-white">!</span>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
