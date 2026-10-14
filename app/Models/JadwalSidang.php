<?php
// app/Models/JadwalSidang.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalSidang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bimbingan(): BelongsTo
    {
        return $this->belongsTo(Bimbingan::class);
    }
}