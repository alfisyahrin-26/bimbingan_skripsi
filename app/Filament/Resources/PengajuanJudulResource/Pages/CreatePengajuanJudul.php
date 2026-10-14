<?php

namespace App\Filament\Resources\PengajuanJudulResource\Pages;

use App\Filament\Resources\PengajuanJudulResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengajuanJudul extends CreateRecord
{
    protected static string $resource = PengajuanJudulResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika yang login adalah mahasiswa, tambahkan ID-nya ke data
        if (auth()->user()->hasRole('mahasiswa')) {
            $data['mahasiswa_id'] = auth()->user()->mahasiswa->id;
        }

        return $data;
    }
}
