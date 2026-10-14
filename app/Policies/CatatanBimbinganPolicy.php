<?php
// NAMA FILE: app/Policies/CatatanBimbinganPolicy.php

namespace App\Policies;

use App\Models\CatatanBimbingan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatatanBimbinganPolicy
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
        // Menu ini sebaiknya hanya diakses Dosen
        return $user->hasRole('dosen');
    }

    public function view(User $user, CatatanBimbingan $catatanBimbingan): bool
    {
        // Logika untuk melihat detail (Dosen/Mahasiswa ybs)
        $bimbingan = $catatanBimbingan->bimbinganRequest->bimbingan;
        if ($user->hasRole('dosen')) {
            return $bimbingan->dosen_id === $user->dosen?->id;
        }
        if ($user->hasRole('mahasiswa')) {
            return $bimbingan->mahasiswa_id === $user->mahasiswa?->id;
        }
        return false;
    }

    public function create(User $user): bool
    {
        // Hanya Dosen yang boleh membuat catatan bimbingan
        return $user->hasRole('dosen');
    }

    public function update(User $user, CatatanBimbingan $catatanBimbingan): bool
    {
        // Hanya Dosen ybs yang boleh update
        return $catatanBimbingan->bimbinganRequest->bimbingan->dosen_id === $user->dosen?->id;
    }
    
    public function delete(User $user, CatatanBimbingan $catatanBimbingan): bool
    {
        return false;
    }
}