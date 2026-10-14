<?php
// NAMA FILE: app/Policies/PengajuanJudulPolicy.php

namespace App\Policies;

use App\Models\PengajuanJudul;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengajuanJudulPolicy
{
    use HandlesAuthorization;

    /**
     * INI ADALAH FIX UNTUK TOMBOL "NEW PENGAJUAN JUDUL"
     * Admin bisa melakukan apa saja, KECUALI 'create'.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin') && $ability !== 'create') {
            return true;
        }

        return null; // Lanjutkan ke pengecekan ability lain
    }

    /**
     * Menentukan apakah user bisa melihat daftar pengajuan judul.
     * Admin sudah diizinkan oleh before().
     * Mahasiswa diizinkan di sini.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('mahasiswa');
    }

    /**
     * Menentukan apakah user bisa melihat detail sebuah pengajuan judul.
     */
    public function view(User $user, PengajuanJudul $pengajuanJudul): bool
    {
        return $user->hasRole('mahasiswa') && $pengajuanJudul->mahasiswa_id === optional($user->mahasiswa)->id;
    }

    /**
     * Menentukan apakah user bisa membuat pengajuan judul baru.
     * HANYA Mahasiswa.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('mahasiswa');
    }

    /**
     * Menentukan apakah user bisa mengupdate pengajuan judul.
     */
    public function update(User $user, PengajuanJudul $pengajuanJudul): bool
    {
        return $user->hasRole('mahasiswa') &&
               $pengajuanJudul->mahasiswa_id === optional($user->mahasiswa)->id &&
               $pengajuanJudul->status === 'pending';
    }

    /**
     * Menentukan apakah user bisa menghapus pengajuan judul.
     */
    public function delete(User $user, PengajuanJudul $pengajuanJudul): bool
    {
        return $user->hasRole('mahasiswa') &&
               $pengajuanJudul->mahasiswa_id === optional($user->mahasiswa)->id &&
               $pengajuanJudul->status === 'pending';
    }

    public function restore(User $user, PengajuanJudul $pengajuanJudul): bool
    {
        return false;
    }

    public function forceDelete(User $user, PengajuanJudul $pengajuanJudul): bool
    {
        return false;
    }
}