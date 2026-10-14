<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pengajuanJuduls(): HasMany // Mahasiswa bisa beberapa kali pengajuan jika ditolak
    {
        return $this->hasMany(PengajuanJudul::class);
    }

    public function bimbingan(): HasOne // Mahasiswa hanya punya 1 bimbingan aktif
    {
        return $this->hasOne(Bimbingan::class);
    }
}