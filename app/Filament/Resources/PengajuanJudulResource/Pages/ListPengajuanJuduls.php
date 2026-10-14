<?php

namespace App\Filament\Resources\PengajuanJudulResource\Pages;

use App\Filament\Resources\PengajuanJudulResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanJuduls extends ListRecords
{
    protected static string $resource = PengajuanJudulResource::class;

    // --- TAMBAHKAN BARIS INI ---
    protected static ?string $pollingInterval = '5s';
    // --- BATAS TAMBAHAN ---

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
