<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PreorderController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'whatsapp' => ['required', 'string', 'max:30'],
            'phone_series' => ['required', 'string', 'max:150'],
            'storage' => ['required', 'string', 'max:50'],
            'color' => ['required', 'string', 'max:80'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $preorder = Preorder::create($data);
        $message = implode("\n", [
            "Halo SecondByMePhone, saya sudah mengajukan preorder HP #{$preorder->id}:",
            '',
            "Nama: {$preorder->customer_name}",
            "Nomor WhatsApp: {$preorder->whatsapp}",
            "Merek/Seri: {$preorder->phone_series}",
            "Kapasitas: {$preorder->storage}",
            "Warna: {$preorder->color}",
            'Catatan: '.($preorder->notes ?: '-'),
        ]);

        return redirect()->away('https://wa.me/6281222621419?text='.rawurlencode($message));
    }
}
