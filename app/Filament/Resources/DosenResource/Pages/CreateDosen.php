<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User; // <-- TAMBAHKAN
use Illuminate\Support\Facades\Hash; // <-- TAMBAHKAN
use Spatie\Permission\Models\Role;

class CreateDosen extends CreateRecord
{
    protected static string $resource = DosenResource::class;

    // --- TAMBAHKAN FUNGSI INI ---
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // 1. Buat User baru
        $user = User::create([
            'name' => $data['nama_lengkap'], // Ambil nama dari form
            'email' => $data['email'],
            'password' => $data['password'], // Password sudah di-hash oleh form
        ]);

        // 2. Beri role 'dosen' ke user baru
        $dosenRole = Role::findByName('dosen');
        if ($dosenRole) {
            $user->assignRole($dosenRole);
        }

        // 3. Buat Dosen baru dan hubungkan dengan user_id
        $dosen = static::getModel()::create([
            'user_id' => $user->id,
            'nama_lengkap' => $data['nama_lengkap'],
            'nidn' => $data['nidn'],
        ]);

        return $dosen;
    }
    // --- BATAS TAMBAHAN ---
}
