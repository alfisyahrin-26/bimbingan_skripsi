<?php
// NAMA FILE: app/Models/JudulDiajukan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JudulDiajukan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pengajuanJudul(): BelongsTo
    {
        return $this->belongsTo(PengajuanJudul::class);
    }
}