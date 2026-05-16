<?php

namespace App\Filament\Resources\Pembelians\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PembelianTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('tgl_beli', 'desc')
            ->columns([
                TextColumn::make('pemasok.nama_toko')
                    ->label('Pemasok')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('bahanBaku.nama_bahan')
                    ->label('Bahan Baku')
                    ->searchable()
                    ->badge()
                    ->color('primary'),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state, $record) => number_format($state) . ' ' . ($record->bahanBaku->satuan ?? '')),
                TextColumn::make('tgl_beli')
                    ->label('Tanggal Beli')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('pemasok_id')
                    ->relationship('pemasok', 'nama_toko')
                    ->label('Filter Pemasok'),
                SelectFilter::make('bahan_baku_id')
                    ->relationship('bahanBaku', 'nama_bahan')
                    ->label('Filter Bahan'),
            ])
            ->actions([
                EditAction::make()
                    ->label('Edit'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ]);
    }
}
