<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User; // <-- TAMBAHKAN
use Illuminate\Support\Facades\Hash; // <-- TAMBAHKAN
use Spatie\Permission\Models\Role;

class CreateMahasiswa extends CreateRecord
{
    protected static string $resource = MahasiswaResource::class;

    // --- TAMBAHKAN FUNGSI INI ---
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // 1. Buat User baru
        $user = User::create([
            'name' => $data['nama_lengkap'], // Ambil nama dari form
            'email' => $data['email'],
            'password' => $data['password'], // Password sudah di-hash oleh form
        ]);

        // 2. Beri role 'mahasiswa' ke user baru
        $mahasiswaRole = Role::findByName('mahasiswa');
        if ($mahasiswaRole) {
            $user->assignRole($mahasiswaRole);
        }

        // 3. Buat Mahasiswa baru dan hubungkan dengan user_id
        $mahasiswa = static::getModel()::create([
            'user_id' => $user->id,
            'nama_lengkap' => $data['nama_lengkap'],
            'nim' => $data['nim'],
        ]);

        return $mahasiswa;
    }
    // --- BATAS TAMBAHAN ---
}