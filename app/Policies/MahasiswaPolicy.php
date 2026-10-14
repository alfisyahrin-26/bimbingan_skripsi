<?php

namespace App\Policies;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MahasiswaPolicy
{
    use HandlesAuthorization;

    /**
     * Admin boleh melakukan apa saja.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    // Izinkan role lain (selain admin) untuk melihat list dosen
    public function viewAny(User $user): bool
    {
        return $user->hasRole('mahasiswa'); // Misal, mahasiswa boleh lihat daftar dosen
    }

    // Izinkan role lain melihat detail dosen
    public function view(User $user, Dosen $dosen): bool
    {
        return $user->hasRole('mahasiswa');
    }

    // Hanya admin yg bisa create/update/delete (ditangani 'before')
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Dosen $dosen): bool
    {
        return false;
    }

    public function delete(User $user, Dosen $dosen): bool
    {
        return false;
    }
}