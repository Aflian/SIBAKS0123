<?php

namespace App\Filament\Resources\ProduksiDetails\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Schema;
use App\Models\BahanBaku;

class ProduksiDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Detail Penggunaan Bahan')
                    ->description('Masukkan bahan baku yang digunakan dalam proses produksi.')
                    ->columns(2)
                    ->schema([

                        Select::make('produksi_id')
                            ->label('Produksi')
                            ->relationship(
                                name: 'produksi',
                                titleAttribute: 'id'
                            )
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('bahan_baku_id')
                            ->label('Bahan Baku')
                            ->relationship(
                                name: 'bahanBaku',
                                titleAttribute: 'nama_bahan'
                            )
                            ->required()
                            ->searchable()
                            ->preload()
                            ->reactive(),

                        TextInput::make('jumlah_digunakan')
                            ->label('Jumlah Digunakan')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->suffix(fn ($get) =>
                                optional(
                                    BahanBaku::find($get('bahan_baku_id'))
                                )->satuan ?? ''
                            )
                            ->rule(function ($get) {
                                return function (string $attribute, $value, $fail) use ($get) {

                                    $bahan = BahanBaku::find($get('bahan_baku_id'));

                                    if ($bahan && $value > $bahan->stok) {
                                        $fail('Jumlah melebihi stok tersedia (' . $bahan->stok . ' ' . $bahan->satuan . ')');
                                    }
                                };
                            }),
                    ]),
            ]);
    }
}
