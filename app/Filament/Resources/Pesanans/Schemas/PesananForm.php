<?php

namespace App\Filament\Resources\Pesanans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PesananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_pelanggan')
                    ->required(),
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
