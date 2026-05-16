<?php

namespace App\Filament\Resources\Pemasoks;

use App\Filament\Resources\Pemasoks\Pages\CreatePemasok;
use App\Filament\Resources\Pemasoks\Pages\EditPemasok;
use App\Filament\Resources\Pemasoks\Pages\ListPemasoks;
use App\Filament\Resources\Pemasoks\Schemas\PemasokForm;
use App\Filament\Resources\Pemasoks\Tables\PemasokTable;
use App\Models\Pemasok;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PemasokResource extends Resource
{
    protected static ?string $model = Pemasok::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;
    protected static ?string $navigationLabel = 'Data Pemasok';
    protected static string | UnitEnum | null $navigationGroup = 'Pengadaan';

    public static function form(Schema $schema): Schema
    {
        return PemasokForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PemasokTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPemasoks::route('/'),
            'create' => CreatePemasok::route('/create'),
            'edit' => EditPemasok::route('/{record}/edit'),
        ];
    }
}
