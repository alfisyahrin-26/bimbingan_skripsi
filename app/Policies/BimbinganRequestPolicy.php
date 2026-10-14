<?php
// NAMA FILE: app/Policies/BimbinganRequestPolicy.php

namespace App\Policies;

use App\Models\BimbinganRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BimbinganRequestPolicy
{
    use HandlesAuthorization;

    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['dosen', 'mahasiswa']);
    }

    public function view(User $user, BimbinganRequest $bimbinganRequest): bool
    {
        if ($user->hasRole('mahasiswa')) {
            return $bimbinganRequest->bimbingan->mahasiswa_id === $user->mahasiswa?->id;
        }
        if ($user->hasRole('dosen')) {
            // Perbaiki agar dosen pembimbing BISA melihat request
            return $bimbinganRequest->bimbingan->dosen_id === $user->dosen?->id;
        }
        return false;
    }

    /**
     * INI ADALAH PERBAIKANNYA
     */
    public function create(User $user): bool
    {
        // Hanya izinkan 'mahasiswa' membuat request JIKA
        // dia sudah punya data bimbingan yang statusnya 'aktif'.
        if (!$user->hasRole('mahasiswa')) {
            return false;
        }

        // Cek apakah mahasiswa punya bimbingan aktif
        return $user->mahasiswa?->bimbingan()->where('status', 'aktif')->exists();
    }

    public function update(User $user, BimbinganRequest $bimbinganRequest): bool
    {
        if ($user->hasRole('dosen')) {
            return $bimbinganRequest->bimbingan->dosen_id === $user->dosen?->id;
        }
        if ($user->hasRole('mahasiswa')) {
            return $bimbinganRequest->bimbingan->mahasiswa_id === $user->mahasiswa?->id &&
                   $bimbinganRequest->status === 'pending';
        }
        return false;
    }

    public function delete(User $user, BimbinganRequest $bimbinganRequest): bool
    {
         if ($user->hasRole('mahasiswa')) {
            return $bimbinganRequest->bimbingan->mahasiswa_id === $user->mahasiswa?->id &&
                   $bimbinganRequest->status === 'pending';
        }
        return false;
    }
}