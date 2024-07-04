<?php

namespace App\Filament\Resources\WeeklyResource\Pages;

use App\Filament\Resources\WeeklyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeeklies extends ListRecords
{
    protected static string $resource = WeeklyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
