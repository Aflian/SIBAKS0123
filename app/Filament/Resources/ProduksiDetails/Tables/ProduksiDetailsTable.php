<?php

namespace App\Filament\Resources\ProduksiDetails\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;


class ProduksiDetailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')

            ->columns([

                TextColumn::make('produksi.pesanans')
                    ->label('Pelanggan')
                    ->formatStateUsing(fn ($record) =>
                        $record->produksi->pesanans->map(fn ($p) => $p->pelanggan?->nama)->implode(', ')
                    )
                    ->weight('bold'),

                TextColumn::make('produksi.user.name')
                    ->label('Diproduksi Oleh')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('bahanBaku.nama_bahan')
                    ->label('Bahan Baku')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                TextColumn::make('jumlah_digunakan')
                    ->label('Jumlah Digunakan')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state) . ' ' . $record->bahanBaku->satuan
                    ),

                TextColumn::make('bahanBaku.stok')
                    ->label('Sisa Stok')
                    ->badge()
                    ->color(fn ($record) =>
                        $record->bahanBaku->stok <= $record->bahanBaku->minimum_stok
                            ? 'danger'
                            : 'success'
                    )
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state) . ' ' . $record->bahanBaku->satuan
                    ),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([

                SelectFilter::make('produksi_id')
                    ->relationship('produksi', 'id')
                    ->label('Filter Produksi'),

                SelectFilter::make('bahan_baku_id')
                    ->relationship('bahanBaku', 'nama_bahan')
                    ->label('Filter Bahan'),
            ])

            ->actions([
                EditAction::make()
                    ->label('Edit'),
            ])

            ->bulkActions([
                DeleteBulkAction::make()
                    ->label('Hapus Terpilih'),
            ]);
    }
}
