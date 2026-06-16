<?php

namespace App\Filament\Resources\BahanBakus\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

use Filament\Schemas\Schema;

class BahanBakuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Bahan Baku')
                    ->description('Masukkan data bahan baku untuk kebutuhan produksi.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('nama_bahan')
                            ->label('Nama Bahan')
                            ->required()
                            ->maxLength(100)
                            ->autofocus(),

                        Select::make('jenis')
                            ->label('Jenis Bahan')
                            ->options([
                                'bahan_utama' => 'Bahan Utama',
                                'bumbu' => 'Bumbu',
                            ])
                            ->default('bahan_utama')
                            ->required(),

                        TextInput::make('satuan')
                            ->label('Satuan')
                            ->placeholder('Contoh: gram, butir, liter')
                            ->maxLength(20),

                        TextInput::make('stok')
                            ->label('Stok Tersedia')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Jumlah stok yang tersedia saat ini.'),

                        TextInput::make('minimum_stok')
                            ->label('Minimum Stok')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->helperText('Sistem akan memberi peringatan jika stok ≤ minimum stok.'),

                    ]),
            ]);
    }
}
