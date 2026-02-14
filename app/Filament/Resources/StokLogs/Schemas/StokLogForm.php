<?php

namespace App\Filament\Resources\StokLogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bahan_baku_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Select::make('jenis')
                    ->options(['masuk' => 'Masuk', 'keluar' => 'Keluar'])
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('stok_sebelum')
                    ->required()
                    ->numeric(),
                TextInput::make('stok_sesudah')
                    ->required()
                    ->numeric(),
            ]);
    }
}
