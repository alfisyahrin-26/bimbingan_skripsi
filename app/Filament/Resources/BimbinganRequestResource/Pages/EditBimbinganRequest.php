<?php

namespace App\Filament\Resources\BimbinganRequestResource\Pages;

use App\Filament\Resources\BimbinganRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBimbinganRequest extends EditRecord
{
    protected static string $resource = BimbinganRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
