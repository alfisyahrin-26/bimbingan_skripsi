<?php

namespace App\Filament\Resources\BimbinganRequestResource\Pages;

use App\Filament\Resources\BimbinganRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBimbinganRequests extends ListRecords
{
    protected static string $resource = BimbinganRequestResource::class;

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
