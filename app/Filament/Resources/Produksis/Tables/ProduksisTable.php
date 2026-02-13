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

                TextColumn::make('pesanan.nama_pelanggan')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('pesanan.jenis_bakso')
                    ->label('Jenis Bakso')
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

                TextColumn::make('pesanan.status_produksi')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'menunggu' => 'warning',
                        'diproduksi' => 'primary',
                        'selesai' => 'success',
                        default => 'gray',
                    }),

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
