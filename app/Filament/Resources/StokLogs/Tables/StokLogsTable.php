<?php

namespace App\Filament\Resources\StokLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StokLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bahanBaku.nama_bahan')
                    ->label('Bahan'),

                TextColumn::make('jenis')
                    ->badge()
                    ->color(
                        fn($state) =>
                        $state === 'masuk' ? 'success' : 'danger'
                    ),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->formatStateUsing(
                        fn($state, $record) =>
                        number_format($state) . ' ' . $record->bahanBaku->satuan
                    ),

                TextColumn::make('stok_sebelum')
                    ->label('Stok Sebelum'),

                TextColumn::make('stok_sesudah')
                    ->label('Stok Sesudah'),

                TextColumn::make('user.name')
                    ->label('Dilakukan Oleh'),

                TextColumn::make('created_at')
                    ->since(),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
