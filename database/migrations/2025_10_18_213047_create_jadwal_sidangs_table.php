<?php
// NAMA FILE: ...create_jadwal_sidangs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_sidangs', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke data bimbingan (yang berisi mhs, pembimbing, penguji)
            $table->foreignId('bimbingan_id')->constrained()->cascadeOnDelete();

            $table->dateTime('tanggal_sidang');
            $table->string('tempat'); // Bisa Ruangan atau Link Online

            // Status Sidang (BUKAN status bimbingan)
            $table->enum('status_sidang', ['dijadwalkan', 'lulus', 'lulus_revisi', 'gagal'])
                  ->default('dijadwalkan');

            $table->text('catatan_hasil_sidang')->nullable(); // Catatan dari penguji
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_sidangs');
    }
};