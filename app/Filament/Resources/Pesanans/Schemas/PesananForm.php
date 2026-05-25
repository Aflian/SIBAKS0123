<?php

namespace App\Filament\Resources\Pesanans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PesananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('pelanggan_id')
                    ->label('Pelanggan')
                    ->relationship('pelanggan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        TextInput::make('nama')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(100),
                        Textarea::make('alamat'),
                        TextInput::make('nohp')
                            ->label('No. HP')
                            ->maxLength(20),
                    ]),
                TextInput::make('jenis_bakso')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('no_hp'),
                DatePicker::make('tanggal_ambil')
                    ->required(),
                Select::make('status_pembayaran')
                    ->options(['belum_lunas' => 'Belum lunas', 'lunas' => 'Lunas'])
                    ->default('belum_lunas')
                    ->required(),
                Select::make('status_produksi')
                    ->options(['menunggu' => 'Menunggu', 'diproduksi' => 'Diproduksi', 'selesai' => 'Selesai'])
                    ->default('menunggu')
                    ->required(),
            ]);
    }
}
