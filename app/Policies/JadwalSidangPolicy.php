<?php
// NAMA FILE: app/Policies/JadwalSidangPolicy.php

namespace App\Policies;

use App\Models\JadwalSidang;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JadwalSidangPolicy
{
    use HandlesAuthorization;

    /**
     * Izinkan Admin melakukan segalanya.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    /**
     * Siapa yang bisa melihat menu "Jadwal Sidang"?
     */
    public function viewAny(User $user): bool
    {
        // Izinkan Mahasiswa dan Dosen melihat menu ini
        return $user->hasAnyRole(['mahasiswa', 'dosen']);
    }

    /**
     * Siapa yang bisa melihat detail jadwal sidang?
     */
    public function view(User $user, JadwalSidang $jadwalSidang): bool
    {
        // Mahasiswa hanya bisa lihat jadwalnya sendiri
        if ($user->hasRole('mahasiswa')) {
            return $jadwalSidang->bimbingan->mahasiswa_id === $user->mahasiswa?->id;
        }
        // Dosen (pembimbing/penguji) bisa lihat jadwal yang melibatkannya
        if ($user->hasRole('dosen')) {
            return $jadwalSidang->bimbingan->dosen_id === $user->dosen?->id || 
                   $jadwalSidang->bimbingan->penguji_id === $user->dosen?->id;
        }
        return false;
    }

    /**
     * Siapa yang bisa MEMBUAT jadwal sidang baru?
     * HANYA Admin (sudah ditangani oleh 'before').
     */
    public function create(User $user): bool
    {
        return false; // Mahasiswa dan Dosen tidak bisa
    }

    /**
     * Siapa yang bisa MENGEDIT jadwal sidang?
     * HANYA Admin (sudah ditangani oleh 'before').
     */
    public function update(User $user, JadwalSidang $jadwalSidang): bool
    {
        return false; // Mahasiswa dan Dosen tidak bisa
    }

    /**
     * Siapa yang bisa MENGHAPUS jadwal sidang?
     * HANYA Admin (sudah ditangani oleh 'before').
     */
    public function delete(User $user, JadwalSidang $jadwalSidang): bool
    {
        return false;
    }

    // ... (restore & forceDelete biarkan false)
}