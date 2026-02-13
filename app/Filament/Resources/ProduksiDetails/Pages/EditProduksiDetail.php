<?php

namespace App\Filament\Resources\ProduksiDetails\Pages;

use App\Filament\Resources\ProduksiDetails\ProduksiDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduksiDetail extends EditRecord
{
    protected static string $resource = ProduksiDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
