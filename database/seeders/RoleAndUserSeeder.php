<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Roles
        $adminRole = Role::create(['name' => 'admin']);
        $dosenRole = Role::create(['name' => 'dosen']);
        $mahasiswaRole = Role::create(['name' => 'mahasiswa']);

        // 2. Buat User Admin Prodi
        $adminUser = User::create([
            'name' => 'Admin Prodi',
            'email' => 'admin@kampus.ac.id',
            'password' => Hash::make('password')
        ]);
        $adminUser->assignRole($adminRole);

        // 3. Buat User Dosen
        $dosenUser = User::create([
            'name' => 'Mutiara S. Simajuntak S.Kom, M.Kom.',
            'email' => 'mutiara@kampus.ac.id',
            'password' => Hash::make('password')
        ]);
        Dosen::create([
            'user_id' => $dosenUser->id,
            'nidn' => '001234567',
            'nama_lengkap' => 'Mutiara S. Simajuntak, S.Kom, M.Kom.'
        ]);
        $dosenUser->assignRole($dosenRole);

        // 4. Buat User Mahasiswa
        $mahasiswaUser = User::create([
            'name' => 'Alfisyahrin',
            'email' => 'alfisyahrin113@kampus.ac.id',
            'password' => Hash::make('password')
        ]);
        Mahasiswa::create([
            'user_id' => $mahasiswaUser->id,
            'nim' => '123456789',
            'nama_lengkap' => 'Ani Lestari'
        ]);
        $mahasiswaUser->assignRole($mahasiswaRole);
    }
}