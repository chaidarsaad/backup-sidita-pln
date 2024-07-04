<?php

namespace App\Filament\Resources\BapResource\Pages;

use App\Filament\Resources\BapResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBaps extends ListRecords
{
    protected static string $resource = BapResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
