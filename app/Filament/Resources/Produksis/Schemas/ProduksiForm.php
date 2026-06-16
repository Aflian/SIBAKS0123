<?php

namespace App\Filament\Resources\Produksis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class ProduksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Produksi')
                    ->columns(2)
                    ->schema([

                        Select::make('pesanan_ids')
                            ->label('Pesanan')
                            ->options(
                                Pesanan::where('status_produksi', 'menunggu')
                                    ->get()
                                    ->mapWithKeys(fn ($p) => [
                                        $p->id => $p->pelanggan?->nama . ' (' . number_format($p->jumlah) . ' ' . $p->satuan . ' - ' . number_format($p->berat_total_gram) . 'gr)'
                                    ])
                            )
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Pilih satu atau lebih pesanan untuk diproduksi bersama.'),

                        Select::make('user_id')
                            ->label('Diproduksi Oleh')
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name'
                            )
                            ->default(Auth::id())
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        DatePicker::make('tanggal_produksi')
                            ->label('Tanggal Produksi')
                            ->default(now())
                            ->required(),

                        TextInput::make('jumlah_produksi')
                            ->label('Jumlah Produksi (pcs)')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->suffix('pcs'),

                        TextInput::make('total_berat')
                            ->label('Total Berat (gram)')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->suffix('gr'),
                    ]),

                Section::make('Penggunaan Bahan Baku')
                    ->description('Masukkan bahan baku yang digunakan untuk produksi.')
                    ->schema([

                        Repeater::make('produksiDetails')
                            ->relationship()
                            ->schema([

                                Select::make('bahan_baku_id')
                                    ->label('Bahan Baku')
                                    ->relationship(
                                        name: 'bahanBaku',
                                        titleAttribute: 'nama_bahan'
                                    )
                                    ->searchable()
                                    ->required(),

                                TextInput::make('jumlah_digunakan')
                                    ->label('Jumlah Digunakan (gram)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->required()
                                    ->suffix('gr'),
                            ])
                            ->columns(2)
                            ->required(),
                    ]),

                Section::make('Keterangan')
                    ->columns(1)
                    ->schema([
                        Textarea::make('keterangan')
                            ->rows(3)
                            ->placeholder('Tambahkan catatan jika diperlukan...'),
                    ]),
            ]);
    }
}
