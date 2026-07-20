@extends('layouts.admin')

@section('title', 'Keamanan Akun')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div>
            <p class="text-sm font-black text-lime-700">Pengaturan admin</p>
            <h1 class="mt-1 text-3xl font-black tracking-[-.04em] sm:text-4xl">Keamanan Akun</h1>
            <p class="mt-2 text-sm text-slate-500">Gunakan password kuat yang tidak dipakai pada akun lain.</p>
        </div>

        <section class="mt-8 rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-sm sm:p-9">
            <div class="flex items-start gap-4 border-b border-slate-100 pb-6">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl bg-[#171816] text-[#c8ff46]">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="4" y="10" width="16" height="11" rx="2" />
                        <path d="M8 10V7a4 4 0 0 1 8 0v3M12 15v2" />
                    </svg>
                </span>
                <div>
                    <h2 class="font-black">Ganti Password</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-400">Minimal 10 karakter serta mengandung huruf besar, huruf
                        kecil, dan angka.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.profile.password') }}" class="mt-7 grid gap-5">
                @csrf
                @method('PUT')

                <label class="text-sm font-bold">
                    Password saat ini
                    <input name="current_password" type="password" required autocomplete="current-password"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-lime-500">
                </label>

                <label class="text-sm font-bold">
                    Password baru
                    <input name="password" type="password" required autocomplete="new-password"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-lime-500">
                </label>

                <label class="text-sm font-bold">
                    Konfirmasi password baru
                    <input name="password_confirmation" type="password" required autocomplete="new-password"
                        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 outline-none focus:border-lime-500">
                </label>

                <button class="mt-2 rounded-xl bg-[#171816] px-6 py-4 font-black text-white">Simpan Password Baru</button>
            </form>
        </section>
    </div>
@endsection
