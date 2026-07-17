<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('preorders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100);
            $table->string('whatsapp', 30);
            $table->string('phone_series', 150);
            $table->string('storage', 50);
            $table->string('color', 80);
            $table->text('notes')->nullable();
            $table->string('status', 30)->default('baru')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preorders');
    }
};
