<?php
// NAMA FILE: ...add_location_to_bimbingan_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bimbingan_requests', function (Blueprint $table) {
            // Tambahkan kolom 'mode' (online/offline)
            $table->enum('mode', ['online', 'offline'])
                  ->nullable()
                  ->after('alasan_penolakan'); // Tentukan posisi

            // Tambahkan kolom 'tempat' (misal: "Link Google Meet" atau "Ruang Dosen R.304")
            $table->string('tempat')
                  ->nullable()
                  ->after('mode');
        });
    }

    public function down(): void
    {
        Schema::table('bimbingan_requests', function (Blueprint $table) {
            $table->dropColumn(['mode', 'tempat']);
        });
    }
};