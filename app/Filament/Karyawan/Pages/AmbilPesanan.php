<?php

namespace App\Filament\Karyawan\Pages;

use Filament\Pages\Page;
use App\Models\Pesanan;
use App\Models\Produksi;

class AmbilPesanan extends Page
{
    // protected string $view = 'filament.karyawan.pages.ambil-pesanan';
    protected  string $view = 'filament.karyawan.pages.ambil-pesanan';

    public function ambil($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Pastikan masih menunggu
        if ($pesanan->status_produksi !== 'menunggu') {
            return;
        }

        // Buat produksi baru
        Produksi::create([
            'pesanan_id' => $pesanan->id,
            'user_id' => auth()->id(),
            'tanggal_produksi' => now(),
            'jumlah_produksi' => $pesanan->jumlah,
            'keterangan' => 'Diambil oleh karyawan',
        ]);
    }
}
