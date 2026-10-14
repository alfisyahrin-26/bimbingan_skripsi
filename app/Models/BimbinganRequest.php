<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Bimbingan;
class BimbinganRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Casting untuk tanggal
    protected $casts = [
        'tanggal_diajukan' => 'datetime',
        'tanggal_balasan' => 'datetime',
        'tanggal_direvisi' => 'datetime',
    ];

    public function bimbingan(): BelongsTo
    {
        return $this->belongsTo(Bimbingan::class);
    }

    public function catatanBimbingans(): HasMany
    {
        return $this->hasMany(CatatanBimbingan::class);
    }
}