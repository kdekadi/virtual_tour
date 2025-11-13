<?php

namespace App\Filament\Resources\ContentImageResource\Pages;

use App\Filament\Resources\ContentImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContentImage extends EditRecord
{
    protected static string $resource = ContentImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
