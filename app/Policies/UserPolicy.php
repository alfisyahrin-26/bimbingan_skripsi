<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Berikan semua akses ke admin sebelum pengecekan lainnya.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        
        return null; // Lanjutkan ke method lain jika bukan admin
    }

    /**
     * Izinkan user lain (misal: dosen/mhs) melihat list user.
     * (Admin sudah diizinkan oleh before())
     */
    public function viewAny(User $user): bool
    {
        // Set ke false jika hanya admin yg boleh lihat list user
        return false; 
    }

    /**
     * Izinkan user lain melihat profil user tertentu.
     */
    public function view(User $user, User $model): bool
    {
        // User bisa lihat profilnya sendiri
        return $user->id === $model->id;
    }

    /**
     * Hanya admin (dari 'before') yg bisa buat user baru.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * User bisa update profilnya sendiri.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    // Sisanya biarkan false (hanya admin yg boleh delete, restore, dll)
    
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    public function restore(User $user, User $model): bool
    {
        return false;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}