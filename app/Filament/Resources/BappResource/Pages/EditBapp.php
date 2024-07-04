<?php

namespace App\Filament\Resources\BappResource\Pages;

use App\Filament\Resources\BappResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBapp extends EditRecord
{
    protected static string $resource = BappResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
