<?php
// NAMA FILE: ...modify_pengajuan_juduls_for_repeater.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_juduls', function (Blueprint $table) {
            // Hapus kolom-kolom statis
            $table->dropColumn(['judul_1', 'deskripsi_1', 'judul_2', 'deskripsi_2', 'judul_3', 'deskripsi_3']);

            // Ganti kolom 'judul_diterima' (int) menjadi foreign key
            $table->dropColumn('judul_diterima');
            $table->foreignId('judul_diterima_id')->nullable()->after('status')->constrained('judul_diajukans')->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Jika ingin rollback
        Schema::table('pengajuan_juduls', function (Blueprint $table) {
            $table->string('judul_1');
            $table->text('deskripsi_1');
            $table->string('judul_2');
            $table->text('deskripsi_2');
            $table->string('judul_3');
            $table->text('deskripsi_3');

            $table->dropForeign(['judul_diterima_id']);
            $table->dropColumn('judul_diterima_id');
            $table->integer('judul_diterima')->nullable();
        });
    }
};