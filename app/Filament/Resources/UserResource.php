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
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(45)
                    ->validationMessages([
                            'unique' => 'Username sudah digunakan.',
                            'required' => 'Email wajib diisi.',
                            'email' => 'Format email tidak valid.',
                    ]),
                TextInput::make('email')
                    ->email()
                    ->maxLength(99)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                            'unique' => 'Email sudah digunakan.',
                            'required' => 'Email wajib diisi.',
                            'email' => 'Format email tidak valid.',
                    ])
                    ->required(),
                TextInput::make('nomor_telp')
                    ->label('Nomor Telepon')
                    ->required(fn (string $context): bool => $context === 'create') 
                    ->maxLength(45),
                
                Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'pengunjung' => 'Pengunjung',
                    ])
                    ->required(),

                TextInput::make('current_password')
                    ->label('Password Saat Ini')
                    ->password()
                    ->revealable()
                    ->visible(fn (string $context): bool => $context === 'edit')
                    ->required(fn (Forms\Get $get) => filled($get('password'))) 
                    ->rules([
                        fn (Forms\Get $get, $record) => function (string $attribute, $value, $fail) use ($record) {
                            //  $record agar mengecek password user yang sedang diedit, bukan admin yang login
                            if ($record && ! Hash::check($value, $record->password)) {
                                $fail('Password saat ini tidak cocok.');
                            }
                        },
                    ])
                    ->dehydrated(false)
                    ->extraInputAttributes(['novalidate' => 'novalidate']),

                TextInput::make('password')
                    ->label(fn (string $context) => $context === 'create' ? 'Password' : 'Masukan Password Baru')
                    ->password()
                    ->live() // Memicu perubahan state secara realtime
                    ->rule('confirmed')
                    ->revealable()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText(fn (string $context) => $context === 'edit' ? 'Kosongkan jika tidak ingin mengubah password.' : null)
                    ->validationMessages([
                        'confirmed' => 'Konfirmasi password tidak cocok.',
                    ]),

                TextInput::make('password_confirmation')
                    ->label('Konfirmasi Password Baru')
                    ->password()
                    // Muncul jika di halaman create ATAU jika password baru sedang diisi
                    ->visible(fn (Forms\Get $get, string $context) => $context === 'create' || filled($get('password')))
                    ->required(fn (Forms\Get $get, string $context) => $context === 'create' || filled($get('password')))
                    ->dehydrated(false)
                    ->extraInputAttributes(['novalidate' => 'novalidate']) 
                    ->revealable()
                    ->validationMessages([
                        'required' => 'Konfirmasi password wajib diisi.',
                        'confirmed' => 'Konfirmasi password tidak cocok.',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable(), 
                
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                
                TextColumn::make('role')
                    ->label('Role')
                    ->searchable()
                    ->sortable(), 
                
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
