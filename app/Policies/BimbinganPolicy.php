<?php
// NAMA FILE: app/Policies/BimbinganPolicy.php

namespace App\Policies;

use App\Models\Bimbingan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BimbinganPolicy
{
    use HandlesAuthorization;

    /**
     * Berikan semua hak akses ke 'admin' sebelum pengecekan lainnya.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return null; // Lanjutkan ke method lain jika bukan admin
    }

    /**
     * Tentukan apakah user bisa melihat daftar bimbingan.
     * (Admin sudah diizinkan oleh before())
     */
    public function viewAny(User $user): bool
    {
        // Izinkan dosen dan mahasiswa melihat menu ini
        // Filtering data akan diurus oleh Resource
        return $user->hasAnyRole(['dosen', 'mahasiswa']);
    }

    /**
     * Tentukan apakah user bisa melihat detail bimbingan.
     * (Admin sudah diizinkan oleh before())
     */
    public function view(User $user, Bimbingan $bimbingan): bool
    {
        // Izinkan Dosen dan Mahasiswa melihat (akan difilter oleh query)
        return $user->hasAnyRole(['dosen', 'mahasiswa']);
    }

    /**
     * Tentukan apakah user bisa membuat bimbingan baru.
     * Dibuat false karena bimbingan dibuat otomatis oleh Admin
     * saat memproses pengajuan judul.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Tentukan apakah user bisa mengedit bimbingan.
     * (Admin sudah diizinkan oleh before())
     */
    public function update(User $user, Bimbingan $bimbingan): bool
    {
        // Izinkan Dosen mengedit (misal, update status)
        return $user->hasRole('dosen');
    }

    /**
     * Tentukan apakah user bisa menghapus bimbingan.
     */
    public function delete(User $user, Bimbingan $bimbingan): bool
    {
        return false; // Sebaiknya jangan boleh dihapus
    }

    public function restore(User $user, Bimbingan $bimbingan): bool
    {
        return false;
    }

    public function forceDelete(User $user, Bimbingan $bimbingan): bool
    {
        return false;
    }
}