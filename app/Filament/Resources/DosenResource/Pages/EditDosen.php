<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

use App\Models\User; // <-- TAMBAHKAN

use Illuminate\Support\Facades\Hash; // <-- TAMBAHKAN
use Illuminate\Database\Eloquent\Model;

class EditDosen extends EditRecord
{
    protected static string $resource = DosenResource::class;

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
        // $this->record adalah data Dosen
        // $this->record->user adalah data User yang berelasi
        $data['email'] = $this->record->user->email;

        // Kita tidak perlu memuat password
        return $data;
    }

    /**
     * Simpan data ke model Dosen dan User
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // 1. Update data di tabel 'dosens'
        $record->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'nidn' => $data['nidn'],
        ]);

        // 2. Update data di tabel 'users'
        $user = $record->user;
        if ($user) {
            $userData = [
                'name' => $data['nama_lengkap'],
                'email' => $data['email'],
            ];

            // Cek jika admin mengisi password baru
            // Form Anda sudah otomatis me-hash password jika diisi
            if (!empty($data['password'])) {
                $userData['password'] = $data['password'];
            }

            $user->update($userData);
        }

        return $record;
    }
}
