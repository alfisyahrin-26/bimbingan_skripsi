<?php
// NAMA FILE: ...create_judul_diajukans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('judul_diajukans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_judul_id')->constrained()->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('judul_diajukans');
    }
};