<?php

namespace App\Filament\Resources\Pesanans\Pages;

use App\Filament\Resources\Pesanans\PesananResource;
use App\Models\Pelanggan;
use Filament\Resources\Pages\CreateRecord;

class CreatePesanan extends CreateRecord
{
    protected static string $resource = PesananResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $pelanggan = Pelanggan::find($data['pelanggan_id']);
        $data['nama_pelanggan'] = $pelanggan->nama;

        return $data;
    }
}
