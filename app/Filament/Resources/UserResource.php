<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('username')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('nomor_telp')
                    ->label('Nomor Telepon'),
                
                Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'pengunjung' => 'Pengunjung',
                    ])
                    ->required(),

                // 2. Pengaturan khusus untuk Password
                TextInput::make('password')
                    ->password() // Tipe input password
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)) // Hash saat menyimpan
                    ->dehydrated(fn ($state) => filled($state)) // Hanya simpan jika diisi
                    ->required(fn (string $context): bool => $context === 'create') // Wajib saat 'Create'
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // INI ADALAH KOLOM YANG HILANG
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable(), // Bisa dicari
                
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                
                TextColumn::make('role')
                    ->label('Role')
                    ->sortable(), // Bisa di-sort
                
                TextColumn::make('nomor_telp')
                    ->label('Telepon'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
