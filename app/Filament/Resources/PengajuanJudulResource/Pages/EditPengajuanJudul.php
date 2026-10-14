<?php

namespace App\Filament\Resources\PengajuanJudulResource\Pages;

use App\Filament\Resources\PengajuanJudulResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengajuanJudul extends EditRecord
{
    protected static string $resource = PengajuanJudulResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
