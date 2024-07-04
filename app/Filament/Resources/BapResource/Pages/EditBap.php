<?php

namespace App\Filament\Resources\BapResource\Pages;

use App\Filament\Resources\BapResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBap extends EditRecord
{
    protected static string $resource = BapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
