<?php

namespace App\Filament\Karyawan\Pages;

use Filament\Pages\Page;
use App\Models\Pesanan;
use App\Models\Produksi;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AmbilPesanan extends Page
{
    protected string $view = 'filament.karyawan.pages.ambil-pesanan';

    public $selectedPesanan = [];

    public function ambil()
    {
        $selectedIds = array_keys(array_filter($this->selectedPesanan ?? []));

        if (empty($selectedIds)) {
            Notification::make()
                ->title('Pilih minimal satu pesanan')
                ->danger()
                ->send();
            return;
        }

        $pesanans = Pesanan::whereIn('id', $selectedIds)
            ->where('status_produksi', 'menunggu')
            ->get();

        if ($pesanans->isEmpty()) {
            Notification::make()
                ->title('Pesanan sudah tidak tersedia')
                ->danger()
                ->send();
            return;
        }

        $totalBerat = $pesanans->sum(fn ($p) => $p->berat_total_gram);
        $totalPcs = (int) ceil($totalBerat / 200);

        $produksi = Produksi::create([
            'user_id' => Auth::id(),
            'tanggal_produksi' => now(),
            'jumlah_produksi' => $totalPcs,
            'total_berat' => $totalBerat,
            'keterangan' => 'Diambil oleh karyawan',
        ]);

        foreach ($pesanans as $pesanan) {
            $produksi->pesanans()->attach($pesanan->id);
        }

        Notification::make()
            ->title(count($pesanans) . ' pesanan berhasil diambil untuk produksi')
            ->success()
            ->send();

        $this->selectedPesanan = [];
    }
}
