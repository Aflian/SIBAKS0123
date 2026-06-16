<?php

namespace App\Filament\Resources\Produksis\Pages;

use App\Filament\Resources\Produksis\ProduksiResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduksi extends CreateRecord
{
    protected static string $resource = ProduksiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['jumlah_produksi'] = (int) $data['jumlah_produksi'];
        $data['total_berat'] = (int) $data['total_berat'];
        return $data;
    }

    protected function afterCreate(): void
    {
        $produksi = $this->record;
        $pesananIds = $this->data['pesanan_ids'] ?? [];

        foreach ($pesananIds as $pesananId) {
            $produksi->pesanans()->attach($pesananId);
        }

        foreach ($produksi->pesanans as $pesanan) {
            if ($pesanan->status_produksi === 'menunggu') {
                $pesanan->update(['status_produksi' => 'diproduksi']);
            }
        }
    }
}
