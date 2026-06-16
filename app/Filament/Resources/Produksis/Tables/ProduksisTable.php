<?php

namespace App\Filament\Resources\Produksis\Tables;

use Filament\Tables\Table;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;

use Illuminate\Database\Eloquent\Builder;

class ProduksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('tanggal_produksi', 'desc')

            ->columns([

                TextColumn::make('pesanans')
                    ->label('Pelanggan')
                    ->formatStateUsing(function ($record) {
                        return $record->pesanans->map(fn ($p) => $p->pelanggan?->nama)->implode(', ');
                    })
                    ->weight('bold'),

                TextColumn::make('pesanans')
                    ->label('Detail Pesanan')
                    ->formatStateUsing(function ($record) {
                        return $record->pesanans->map(fn ($p) =>
                            number_format($p->jumlah) . ' ' . $p->satuan . ' (' . number_format($p->berat_total_gram) . 'gr)'
                        )->implode(', ');
                    })
                    ->badge()
                    ->color('primary'),

                TextColumn::make('user.name')
                    ->label('Diproduksi Oleh')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('tanggal_produksi')
                    ->label('Tanggal Produksi')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('jumlah_produksi')
                    ->label('Jumlah Produksi')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => number_format($state) . ' pcs'),

                TextColumn::make('total_berat')
                    ->label('Total Berat')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state) . ' gr'),

                TextColumn::make('status_produksi')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($record) => match (true) {
                        $record->pesanans->contains(fn ($p) => $p->status_produksi === 'selesai') => 'success',
                        $record->pesanans->contains(fn ($p) => $p->status_produksi === 'diproduksi') => 'primary',
                        default => 'warning',
                    })
                    ->getStateUsing(fn ($record) => $record->pesanans->first()?->status_produksi ?? '-'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([

                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Filter Karyawan'),

                Filter::make('hari_ini')
                    ->label('Produksi Hari Ini')
                    ->query(fn (Builder $query) =>
                        $query->whereDate('tanggal_produksi', today())
                    ),

                Filter::make('bulan_ini')
                    ->label('Produksi Bulan Ini')
                    ->query(fn (Builder $query) =>
                        $query->whereMonth('tanggal_produksi', now()->month)
                              ->whereYear('tanggal_produksi', now()->year)
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
