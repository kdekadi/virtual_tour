<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KomentarResource\Pages;
use App\Models\Komentar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Infolist; 
use Filament\Infolists\Components\TextEntry;

class KomentarResource extends Resource
{
    protected static ?string $model = Komentar::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'Komentar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            //
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
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

                    Tables\Columns\Layout\Panel::make([
                        Tables\Columns\TextColumn::make('isi_komentar')
                            ->size('sm')
                            ->wrap()
                            ->extraAttributes([
                                'style' => 'word-break: break-all; color: #374151;',
                            ]),
                    ]),

                    Tables\Columns\Layout\Split::make([
                        Tables\Columns\TextColumn::make('parent.user.username')
                            ->formatStateUsing(function ($record) {
                                if (!$record->parent_id) return null;
                                $username = $record->parent->user->username ?? 'Guest';
                                $cuplikan = str($record->parent->isi_komentar)->limit(25);

                                return "↳ Membalas $username: \"$cuplikan\"";
                            })
                            ->size('xs')
                            ->color('warning')
                            ->tooltip(fn ($record) => $record->parent?->isi_komentar)
                            ->grow(false),
                            
                        Tables\Columns\IconColumn::make('is_read')
                            ->boolean()
                            ->trueIcon('heroicon-o-envelope-open')
                            ->falseIcon('heroicon-o-envelope')
                            ->alignEnd(),
                    ]),
                ])->space(3),
            ])
            ->contentGrid(['md' => 1])
            ->defaultSort('waktu_komentar', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Status Komentar')
                    ->native(false)
                    ->placeholder('Semua Komentar')
                    ->trueLabel('Sudah Dibaca')
                    ->falseLabel('Komentar Baru')
                    ->queries(
                        true: fn (Builder $query) => $query->where('is_read', true),
                        false: fn (Builder $query) => $query->where('is_read', false),
                    ),
            ])
            ->filtersTriggerAction(
                fn (Tables\Actions\Action $action) => $action
                    ->button()
                    ->label('Filter Komentar')
                    ->icon('heroicon-m-adjustments-horizontal') 
                    ->color('primary'),
            )
            ->actions([
                Tables\Actions\Action::make('markAsRead')
                    ->label('Tandai')
                    ->icon('heroicon-o-check')
                    ->action(fn ($record) => $record->update(['is_read' => true]))
                    ->hidden(fn ($record) => $record->is_read),

                Tables\Actions\Action::make('balas')
                    ->label('Balas')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('success')
                    ->size('sm')
                    ->form([
                        Forms\Components\Textarea::make('isi_balasan')
                            ->label('Tulis Balasan Admin')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (array $data, $record) {
                        Komentar::create([
                            'isi_komentar' => $data['isi_balasan'],
                            'id_users' => auth()->id(),
                            'parent_id' => $record->id_komentar,
                            'waktu_komentar' => now(),
                            'is_read' => true,
                        ]);
                    }),
                    
                Tables\Actions\DeleteAction::make()->size('sm'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'parent.user']);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('user.username')->label('Pengirim'),
            TextEntry::make('waktu_komentar')->label('Waktu')->dateTime(),
            TextEntry::make('isi_komentar')
                ->label('Komentar Lengkap')
                ->columnSpanFull()
                ->prose(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKomentars::route('/'),
        ];
    }
}