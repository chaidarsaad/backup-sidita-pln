<?php

namespace App\Filament\Resources\TermynResource\Pages;

use App\Filament\Resources\TermynResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTermyn extends EditRecord
{
    protected static string $resource = TermynResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
