<?php

namespace App\Filament\Resources\BahanBakus\Tables;

use Filament\Tables\Table;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;

use Illuminate\Database\Eloquent\Builder;

class BahanBakusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')

            ->columns([

                TextColumn::make('nama_bahan')
                    ->label('Nama Bahan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'bahan_utama' => 'Bahan Utama',
                        'bumbu' => 'Bumbu',
                        default => $state,
                    })
                    ->color(fn ($state) => $state === 'bahan_utama' ? 'primary' : 'success'),

                TextColumn::make('stok')
                    ->label('Stok Saat Ini')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn ($record) =>
                        $record->stok <= $record->minimum_stok
                            ? 'danger'
                            : 'success'
                    )
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state) . ' ' . $record->satuan
                    ),

                TextColumn::make('minimum_stok')
                    ->label('Minimum Stok')
                    ->numeric()
                    ->sortable()
                    ->color('warning')
                    ->formatStateUsing(fn ($state, $record) =>
                        number_format($state) . ' ' . $record->satuan
                    ),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y H:i')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y H:i')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                Filter::make('stok_menipis')
                    ->label('Stok Menipis')
                    ->query(fn (Builder $query) =>
                        $query->whereColumn('stok', '<=', 'minimum_stok')
                    ),
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
