<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    public const STATUSES = [
        'baru' => 'Baru',
        'diproses' => 'Diproses',
        'tersedia' => 'Barang Tersedia',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    protected $fillable = ['customer_name', 'whatsapp', 'phone_series', 'storage', 'color', 'notes', 'status'];

    public function getWhatsappAttribute(?string $value): string
    {
        $number = preg_replace('/\D/', '', (string) $value);
        if (str_starts_with($number, '0')) {
            return '62'.substr($number, 1);
        }

        return str_starts_with($number, '62') ? $number : '62'.$number;
    }
}
