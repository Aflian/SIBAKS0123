<?php

namespace App\Filament\Resources\Pembelians\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PembelianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pemasok_id')
                    ->label('Pemasok')
                    ->relationship('pemasok', 'nama_toko')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('bahan_baku_id')
                    ->label('Bahan Baku')
                    ->relationship('bahanBaku', 'nama_bahan')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                DatePicker::make('tgl_beli')
                    ->label('Tanggal Beli')
                    ->default(now())
                    ->required(),
                TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->minValue(0)
                    ->prefix('Rp')
                    ->required(),
            ]);
    }
}
