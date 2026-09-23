<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('app:install', function () {
    if (User::query()->exists() || Product::query()->exists()) {
        $this->info('Data aplikasi sudah tersedia. Seeder dilewati.');

        return;
    }

    $this->call('db:seed', ['--force' => true]);
    $this->info('Data awal aplikasi berhasil dibuat.');
})->purpose('Create the initial admin and product catalog on an empty database');
