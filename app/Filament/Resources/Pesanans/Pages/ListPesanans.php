<?php

namespace App\Filament\Resources\Pesanans\Pages;

use App\Filament\Resources\Pesanans\PesananResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class ListPesanans extends ListRecords
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->action(function () {
                    $query = $this->getFilteredTableQuery();
                    $pesanans = $query->with('pelanggan')->get();

                    $filterInfo = $this->getFilterInfo();

                    $pdf = Pdf::loadView('pdf.pesanan', [
                        'pesanans' => $pesanans,
                        'filterInfo' => $filterInfo,
                    ]);

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->output();
                    }, 'laporan-pesanan-' . now()->format('Y-m-d') . '.pdf');
                }),
        ];
    }

    protected function getFilterInfo(): ?string
    {
        $parts = [];

        $filters = $this->tableFilters ?? [];

        if ($filters) {
            if ($value = $filters['status_pembayaran']['value'] ?? null) {
                $parts[] = 'Pembayaran: ' . ($value === 'lunas' ? 'Lunas' : 'Belum Lunas');
            }
            if ($value = $filters['status_produksi']['value'] ?? null) {
                $parts[] = 'Status: ' . $value;
            }
            if (isset($filters['tanggal_ambil'])) {
                if ($dari = $filters['tanggal_ambil']['dari'] ?? null) {
                    $parts[] = 'Dari: ' . $dari;
                }
                if ($sampai = $filters['tanggal_ambil']['sampai'] ?? null) {
                    $parts[] = 'Sampai: ' . $sampai;
                }
            }
        }

        return $parts ? implode(' | ', $parts) : null;
    }
}
