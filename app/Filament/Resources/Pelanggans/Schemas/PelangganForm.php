<?php

namespace App\Filament\Resources\Pelanggans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PelangganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Pelanggan')
                    ->required()
                    ->maxLength(100),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('nohp')
                    ->label('No. HP')
                    ->maxLength(20),
            ]);
    }
}
