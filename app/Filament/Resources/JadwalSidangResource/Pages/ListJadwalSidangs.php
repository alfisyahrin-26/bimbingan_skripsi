<?php

namespace App\Filament\Resources\JadwalSidangResource\Pages;

use App\Filament\Resources\JadwalSidangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalSidangs extends ListRecords
{
    protected static string $resource = JadwalSidangResource::class;

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
