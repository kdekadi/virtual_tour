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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListContentWebs::route('/'),
            'create' => Pages\CreateContentWeb::route('/create'),
            'edit' => Pages\EditContentWeb::route('/{record}/edit'),
        ];
    }
}
