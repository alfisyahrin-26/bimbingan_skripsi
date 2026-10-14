<?php
// NAMA FILE: app/Models/Bimbingan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bimbingan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Ini adalah Dosen Pembimbing
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    // --- INI PERUBAHANNYA ---
    // (Relasi pembimbingDua() dihapus)
    // Ini adalah Dosen Penguji
    public function penguji(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'penguji_id');
    }
    // --- BATAS PERUBAHAN ---

    public function pengajuanJudul(): BelongsTo
    {
        return $this->belongsTo(PengajuanJudul::class);
    }

    public function bimbinganRequests(): HasMany
    {
        return $this->hasMany(BimbinganRequest::class);
    }

    public function jadwalSidang(): HasOne
    {
        return $this->hasOne(JadwalSidang::class);
    }
}