<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentWebResource\Pages;
use App\Filament\Resources\ContentWebResource\RelationManagers;
use App\Models\ContentWeb;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea; // Ganti RichEditor jika ingin teks sederhana
use Filament\Forms\Components\RichEditor; 
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;

class ContentWebResource extends Resource
{
    protected static ?string $model = ContentWeb::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Content Web';
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nama_content_web')
                ->label('Nama Content Web')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(200),
                // ->helperText('sejarah1')

            // Pilihan: Ganti RichEditor dengan Textarea jika Anda tidak ingin format HTML
            RichEditor::make('isi_content_web') 
            // Textarea::make('isi_content_web') 
                ->label('Isi Konten Teks')
                // ->required()
                ->nullable()
                ->columnSpanFull(), 

            // 3. SOLUSI: HIDDEN FIELD UNTUK ID_USERS
                Hidden::make('id_users')
                    ->default(Auth::id()) // Ambil ID pengguna yang sedang login
                    ->required(), // Meskipun hidden, tetap wajib diisi karena di DB NOT NULL

            // Repeater untuk Mengelola Gambar (Tabel content_image)
            Repeater::make('images')
                ->relationship('images') 
                ->label('Gambar')
                ->schema([
                    FileUpload::make('image_path')->directory('content-images')
                        ->label('Upload Gambar')
                        // ->required()
                        ->image()
                        ->directory('content-images') // Folder di storage/app/public/
                        ->visibility('public')
                        ->disk('public'), 
                ])
                ->columns(1)
                ->columnSpanFull()
                ->createItemButtonLabel('Tambah Gambar Baru'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
           ->columns([
            TextColumn::make('nama_content_web')->searchable()->sortable(),
            TextColumn::make('isi_content_web')->label('Ringkasan Konten')->limit(50)->html(), 
            TextColumn::make('images_count')->counts('images')->label('Jml Gambar')->badge(),
            TextColumn::make('user.username')->label('Diubah Oleh')->default('Admin Sistem'), 
            TextColumn::make('updated_at')->dateTime()->label('Terakhir Update')->sortable(),
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

    // Tambahkan di luar fungsi form, table, atau getPages
    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_users'] = Auth::id();
        return $data;
    }

    protected static function mutateFormDataBeforeSave(array $data): array
    {
        $data['id_users'] = Auth::id();
        return $data;
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
            'index' => Pages\ListContentWebs::route('/'),
            'create' => Pages\CreateContentWeb::route('/create'),
            'edit' => Pages\EditContentWeb::route('/{record}/edit'),
        ];
    }
}
