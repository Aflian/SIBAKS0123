<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pesanan;
use App\Models\Produksi;
use App\Models\BahanBaku;

class AdminStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Total Pesanan', Pesanan::count())
                ->description('Semua pesanan yang tercatat')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),

            Stat::make(
                'Produksi Hari Ini',
                Produksi::whereDate('tanggal_produksi', today())->count()
            )
                ->description('Produksi yang dilakukan hari ini')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('success'),

            Stat::make('Total Bahan Baku', BahanBaku::count())
                ->description('Jumlah jenis bahan baku')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('info'),

            Stat::make(
                'Stok Menipis',
                BahanBaku::whereColumn('stok', '<=', 'minimum_stok')->count()
            )
                ->description('Bahan yang perlu segera dibeli')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),

            Stat::make(
                'Pesanan Lunas',
                Pesanan::where('status_pembayaran', 'lunas')->count()
            )
                ->description('Pesanan yang sudah dibayar')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make(
                'Pesanan Menunggu',
                Pesanan::where('status_produksi', 'menunggu')->count()
            )
                ->description('Belum diproduksi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

        ];
    }


    public static function canView(): bool
    {
        return auth()->user()?->role === 'admin';
    }

}
