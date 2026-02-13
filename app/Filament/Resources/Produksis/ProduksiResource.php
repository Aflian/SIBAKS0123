<?php

namespace App\Filament\Resources\Produksis;

use App\Filament\Resources\Produksis\Pages\CreateProduksi;
use UnitEnum;
use App\Filament\Resources\Produksis\Pages\EditProduksi;
use App\Filament\Resources\Produksis\Pages\ListProduksis;
use App\Filament\Resources\Produksis\Schemas\ProduksiForm;
use App\Filament\Resources\Produksis\Tables\ProduksisTable;
use App\Models\Produksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProduksiResource extends Resource
{
    protected static ?string $model = Produksi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Manajemen Produksi';
    protected static string | UnitEnum | null $navigationGroup = 'Produksi';

    public static function form(Schema $schema): Schema
    {
        return ProduksiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProduksisTable::configure($table);
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
            'index' => ListProduksis::route('/'),
            'create' => CreateProduksi::route('/create'),
            'edit' => EditProduksi::route('/{record}/edit'),
        ];
    }
}
