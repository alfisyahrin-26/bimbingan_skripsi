<?php
// NAMA FILE: xxxx_xx_xx_xxxxxx_add_penguji_id_to_bimbingans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bimbingans', function (Blueprint $table) {
            // 'dosen_id' adalah Pembimbing
            // Kita tambahkan 'penguji_id'
            $table->foreignId('penguji_id')
                  ->nullable()
                  ->after('dosen_id') // Posisikan setelah 'dosen_id'
                  ->constrained('dosens') // Referensi ke tabel 'dosens'
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('bimbingans', function (Blueprint $table) {
            $table->dropForeign(['penguji_id']);
            $table->dropColumn('penguji_id');
        });
    }
};