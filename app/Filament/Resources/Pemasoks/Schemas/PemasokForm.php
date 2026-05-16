<?php

namespace App\Filament\Resources\Pemasoks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PemasokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_toko')
                    ->label('Nama Toko')
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
