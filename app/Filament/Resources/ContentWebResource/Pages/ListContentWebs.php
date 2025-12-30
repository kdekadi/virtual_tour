<?php

namespace App\Filament\Resources\ContentWebResource\Pages;

use App\Filament\Resources\ContentWebResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab; // Pastikan import ini ada
use Illuminate\Database\Eloquent\Builder;

class ListContentWebs extends ListRecords
{
    protected static string $resource = ContentWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Konten'),
            'home' => Tab::make('Halaman Home')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('label', 'like', '%home%'))
                ->icon('heroicon-m-home'),
            'sejarah' => Tab::make('Halaman Sejarah')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('label', 'like', '%sejarah%'))
                ->icon('heroicon-m-book-open'),
            'galeri' => Tab::make('Galeri')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('label', 'like', '%galeri%'))
                ->icon('heroicon-m-photo'),
            'informasi' => Tab::make('Informasi')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('label', 'like', '%Informasi%'))
                ->icon('heroicon-m-information-circle'),
        ];
    }
}