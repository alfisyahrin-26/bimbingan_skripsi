<?php
// NAMA FILE: app/Models/PengajuanJudul.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- TAMBAHKAN
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanJudul extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function bimbingan(): HasOne
    {
        return $this->hasOne(Bimbingan::class);
    }

    // --- TAMBAHAN BARU ---
    // Relasi ke banyak judul
    public function juduls(): HasMany
    {
        return $this->hasMany(JudulDiajukan::class);
    }

    // Relasi ke judul yang diterima
    public function judulDiterima(): BelongsTo
    {
        return $this->belongsTo(JudulDiajukan::class, 'judul_diterima_id');
    }
    // --- BATAS TAMBAHAN ---
}