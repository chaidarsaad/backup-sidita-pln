<?php

namespace App\Filament\Resources\TermynResource\Pages;

use App\Filament\Resources\TermynResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTermyns extends ListRecords
{
    protected static string $resource = TermynResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
