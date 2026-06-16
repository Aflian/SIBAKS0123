<?php

namespace App\Filament\Karyawan\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Produksi;
use App\Models\BahanBaku;

class KaryawanStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();

        return [

            Stat::make(
                'Produksi Aktif',
                Produksi::where('user_id', $userId)
                    ->whereHas('pesanans', fn ($q) =>
                        $q->where('status_produksi', 'diproduksi')
                    )
                    ->count()
            )
            ->description('Sedang dikerjakan')
            ->descriptionIcon('heroicon-m-cog-6-tooth')
            ->color('warning'),

            Stat::make(
                'Produksi Selesai',
                Produksi::where('user_id', $userId)
                    ->whereHas('pesanans', fn ($q) =>
                        $q->where('status_produksi', 'selesai')
                    )
                    ->count()
            )
            ->description('Sudah selesai')
            ->descriptionIcon('heroicon-m-check-circle')
            ->color('success'),

            Stat::make(
                'Total Produksi Saya',
                Produksi::where('user_id', $userId)->count()
            )
            ->description('Semua produksi')
            ->descriptionIcon('heroicon-m-archive-box')
            ->color('primary'),

        ];
    }
}
