<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentWebResource\Pages;
use App\Models\ContentWeb;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ContentWebResource extends Resource
{
    protected static ?string $model = ContentWeb::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationLabel = 'Content Web';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->label('Nama Konten')
                    ->placeholder('Masukan Nama Konten Web')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),

                Forms\Components\TextInput::make('nama_content_web')
                    ->label('Key Sistem (ID)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(200)
                    ->hidden(fn ($context) => $context === 'edit') 
                    ->visible(fn ($context) => $context === 'create')
                    ->helperText('Gunakan format snake_case. Contoh: sejarah_home'),

                Forms\Components\RichEditor::make('isi_content_web') 
                    ->label('Isi Konten Teks')
                    ->nullable()
                    ->columnSpanFull(), 

                Forms\Components\Hidden::make('id_users')
                    ->default(Auth::id())
                    ->required(),

                Forms\Components\Repeater::make('images')
                    ->relationship('images') 
                    ->label('Koleksi Gambar')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Upload Gambar')
                            ->image()
                            ->directory('content-images') 
                            ->visibility('public')
                            ->disk('public'), 
                    ])
                    ->columnSpanFull()
                    ->createItemButtonLabel('Tambah Gambar Baru'),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Nama Konten')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->default(fn ($record) => str($record->nama_content_web)->replace('_', ' ')->title()),

                Tables\Columns\TextColumn::make('isi_content_web')
                    ->label('Ringkasan Konten')
                    ->limit(40)
                    ->html()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('images_count')
                    ->counts('images')
                    ->label('Gambar')
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('user.username')
                    ->label('Diubah Oleh')
                    ->badge()
                    ->color('info')
                    ->default('Admin'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Update Terakhir')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'images']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContentWebs::route('/'),
            'create' => Pages\CreateContentWeb::route('/create'),
            'edit' => Pages\EditContentWeb::route('/{record}/edit'),
        ];
    }
}