<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KomentarResource\Pages;
use App\Filament\Resources\KomentarResource\RelationManagers;
use App\Models\Komentar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist; 
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;


class KomentarResource extends Resource
{
    protected static ?string $model = Komentar::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Koomentar';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\Layout\Stack::make([
                // Baris Atas: Header (User & Waktu)
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\TextColumn::make('user.username')
                        ->weight('bold')
                        ->size('sm')
                        ->color('primary')
                        ->icon('heroicon-m-user-circle')
                        ->grow(false),
                    
                    Tables\Columns\TextColumn::make('waktu_komentar')
                        ->dateTime('d M Y H:i')
                        ->size('xs')
                        ->color('gray')
                        ->alignEnd(),
                ]),

                // Baris Tengah: Bubble Komentar
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\TextColumn::make('isi_komentar')
                        ->size('sm')
                        ->wrap()
                        ->extraAttributes([
                            'style' => 'word-break: break-all; color: #374151;',
                        ]),
                ]),

                // Baris Bawah: Status & Balasan
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\TextColumn::make('parent_id')
                        ->formatStateUsing(fn ($state) => $state ? "↳ Membalas ID: #$state" : null)
                        ->size('xs')
                        ->color('warning'),
                        
                    // Indikator Status Dibaca (Opsional)
                    Tables\Columns\IconColumn::make('is_read')
                        ->boolean()
                        ->trueIcon('heroicon-o-envelope-open')
                        ->falseIcon('heroicon-o-envelope')
                        ->alignEnd(),
                ]),
            ])->space(3),
        ])
        ->contentGrid([
            'md' => 1,
        ])
        ->persistFiltersInSession(false)
        ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Status Komentar')
                    ->indicator(null)
                    ->native(false)
                    ->placeholder('Semua Komentar')
                    ->trueLabel('Sudah Dibaca')
                    ->falseLabel('Komentar Baru')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_read', true),
                        false: fn (Builder $query) => $query->where('is_read', false),
                    )
                    
            ])
            // INI CARA TERBAIK GANTI IKON DROPDOWN FILTER
            ->filtersTriggerAction(
                fn (Tables\Actions\Action $action) => $action
                    ->button()
                    ->label('Filter Komentar')
                    ->icon('heroicon-m-adjustments-horizontal') 
                    ->indicator(null)
                    ->color('primary'),
        )
        ->actions([
            Tables\Actions\Action::make('markAsRead')
                        ->label('Tandai')
                        ->icon('heroicon-o-check')
                        ->action(fn ($record) => $record->update(['is_read' => true]))
                        ->hidden(fn ($record) => $record->is_read),
            // Aksi akan otomatis muncul di pojok kanan bawah setiap kotak jika menggunakan Stack
            Tables\Actions\Action::make('balas')
                ->label('Balas')
                ->icon('heroicon-m-chat-bubble-left-right')
                ->color('success')
                ->size('sm')
                ->form([
                    \Filament\Forms\Components\Textarea::make('isi_balasan')
                        ->label('Tulis Balasan Admin')
                        ->required()
                        ->rows(3),
                ])
                ->action(function (array $data, $record) {
                    \App\Models\Komentar::create([
                        'isi_komentar' => $data['isi_balasan'],
                        'id_users' => auth()->id(),
                        'parent_id' => $record->id_komentar,
                        'waktu_komentar' => now(),
                    ]);
                }),
            Tables\Actions\DeleteAction::make()->size('sm'),
        ])
        ->defaultSort('waktu_komentar', 'desc')

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
            'index' => Pages\ListKomentars::route('/'),
            // 'create' => Pages\CreateKomentar::route('/create'),
            // 'edit' => Pages\EditKomentar::route('/{record}/edit'),
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
    return $infolist
        ->schema([
            TextEntry::make('user.username')->label('Pengirim'),
            TextEntry::make('waktu_komentar')->label('Waktu')->dateTime(),
            TextEntry::make('isi_komentar')
                ->label('Komentar Lengkap')
                ->columnSpanFull() // Memakai seluruh lebar layar modal
                ->prose(), // Memberikan format teks yang nyaman dibaca
        ]);
    }

}
