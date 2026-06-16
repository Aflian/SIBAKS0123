<?php

namespace App\Filament\Resources\Pesanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PesanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelanggan.nama')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('satuan')
                    ->badge()
                    ->color(fn ($state) => $state === 'kg' ? 'info' : 'success')
                    ->formatStateUsing(fn ($state) => $state === 'kg' ? 'Kg' : 'Pcs (200gr)'),
                TextColumn::make('harga')
                    ->numeric(thousandsSeparator: '.')
                    ->prefix('Rp ')
                    ->sortable(),
                TextColumn::make('no_hp')
                    ->searchable(),
                TextColumn::make('tanggal_ambil')
                    ->date()
                    ->sortable(),
                TextColumn::make('status_pembayaran')
                    ->badge(),
                TextColumn::make('status_produksi')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status_pembayaran')
                    ->options([
                        'belum_lunas' => 'Belum Lunas',
                        'lunas' => 'Lunas',
                    ]),
                SelectFilter::make('status_produksi')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diproduksi' => 'Diproduksi',
                        'selesai' => 'Selesai',
                    ]),
                Filter::make('tanggal_ambil')
                    ->label('Tanggal Ambil')
                    ->form([
                        DatePicker::make('dari')->label('Dari'),
                        DatePicker::make('sampai')->label('Sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['dari'], fn (Builder $q, $date) => $q->whereDate('tanggal_ambil', '>=', $date))
                            ->when($data['sampai'], fn (Builder $q, $date) => $q->whereDate('tanggal_ambil', '<=', $date));
                    }),
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
