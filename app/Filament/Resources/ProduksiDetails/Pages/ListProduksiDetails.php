<?php

namespace App\Filament\Resources\ProduksiDetails\Pages;

use App\Filament\Resources\ProduksiDetails\ProduksiDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProduksiDetails extends ListRecords
{
    protected static string $resource = ProduksiDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
