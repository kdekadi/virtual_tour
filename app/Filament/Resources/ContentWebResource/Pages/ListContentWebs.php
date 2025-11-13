<?php

namespace App\Filament\Resources\ContentWebResource\Pages;

use App\Filament\Resources\ContentWebResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContentWebs extends ListRecords
{
    protected static string $resource = ContentWebResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
