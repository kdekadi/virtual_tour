<?php

namespace App\Filament\Resources\KomentarResource\Pages;

use App\Filament\Resources\KomentarResource;
use App\Models\Komentar; // <--- PASTIKAN BARIS INI ADA
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListKomentars extends ListRecords
{
    protected static string $resource = KomentarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua Komentar')
            ->icon('heroicon-m-list-bullet')
            ->badge(Komentar::count()) 
            ->badgeColor('gray'),
                
            'baru' => Tab::make('Komentar Baru')
                ->icon('heroicon-m-bell-alert')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_read', false))
                ->badge(Komentar::where('is_read', false)->count())
                ->badgeColor('danger'),
        ];
    }
}