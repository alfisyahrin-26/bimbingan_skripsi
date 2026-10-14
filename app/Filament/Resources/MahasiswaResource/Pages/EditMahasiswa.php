<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\User; // <-- TAMBAHKAN
use Illuminate\Support\Facades\Hash; // <-- TAMBAHKAN
use Illuminate\Database\Eloquent\Model;

class EditMahasiswa extends EditRecord
{
    protected static string $resource = MahasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Ambil data dari model User dan masukkan ke Form
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['email'] = $this->record->user->email;
        return $data;
    }

    /**
     * Simpan data ke model Mahasiswa dan User
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // 1. Update data di tabel 'mahasiswas'
        $record->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'nim' => $data['nim'],
        ]);

        // 2. Update data di tabel 'users'
        $user = $record->user;
        if ($user) {
            $userData = [
                'name' => $data['nama_lengkap'],
                'email' => $data['email'],
            ];

            // Cek jika admin mengisi password baru
            if (!empty($data['password'])) {
                $userData['password'] = $data['password'];
            }

            $user->update($userData);
        }

        return $record;
    }
}
