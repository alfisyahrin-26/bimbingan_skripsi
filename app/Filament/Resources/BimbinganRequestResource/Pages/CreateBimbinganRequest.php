<?php

namespace App\Filament\Resources\BimbinganRequestResource\Pages;

use App\Filament\Resources\BimbinganRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBimbinganRequest extends CreateRecord
{
    protected static string $resource = BimbinganRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Cari Bimbingan aktif milik mahasiswa yang sedang login
        $bimbingan = auth()->user()->mahasiswa?->bimbingan;

        if ($bimbingan) {
            $data['bimbingan_id'] = $bimbingan->id;
        }

        // Anda bisa tambahkan validasi di sini, 
        // misalnya, 'jika belum punya bimbingan, jangan boleh create'

        return $data;
    }
}