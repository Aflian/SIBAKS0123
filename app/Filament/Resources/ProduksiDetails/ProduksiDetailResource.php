<?php

namespace App\Filament\Resources\ProduksiDetails;

use App\Filament\Resources\ProduksiDetails\Pages\CreateProduksiDetail;
use UnitEnum;
use App\Filament\Resources\ProduksiDetails\Pages\EditProduksiDetail;
use App\Filament\Resources\ProduksiDetails\Pages\ListProduksiDetails;
use App\Filament\Resources\ProduksiDetails\Schemas\ProduksiDetailForm;
use App\Filament\Resources\ProduksiDetails\Tables\ProduksiDetailsTable;
use App\Models\ProduksiDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProduksiDetailResource extends Resource
{
    protected static ?string $model = ProduksiDetail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Manajemen Detail Produksi';
    protected static string | UnitEnum | null $navigationGroup = 'Produksi';

    public static function form(Schema $schema): Schema
    {
        return ProduksiDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProduksiDetailsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProduksiDetails::route('/'),
            'create' => CreateProduksiDetail::route('/create'),
            'edit' => EditProduksiDetail::route('/{record}/edit'),
        ];
    }
}
