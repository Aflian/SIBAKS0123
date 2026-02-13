<?php

namespace App\Filament\Resources\Users\Schemas;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($record) => $record === null) // hanya wajib saat create
                    ->minLength(6)
                    ->helperText('Kosongkan jika tidak ingin mengubah password'),

                Select::make('role')
                    ->options(['admin' => 'Admin', 'karyawan' => 'Karyawan'])
                    ->default('karyawan')
                    ->required(),
            ]);
    }
}
