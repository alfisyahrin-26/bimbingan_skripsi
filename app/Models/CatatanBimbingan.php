<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatanBimbingan extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'tanggal_bimbingan' => 'datetime',
    ];

    public function bimbinganRequest(): BelongsTo
    {
        return $this->belongsTo(BimbinganRequest::class);
    }
}