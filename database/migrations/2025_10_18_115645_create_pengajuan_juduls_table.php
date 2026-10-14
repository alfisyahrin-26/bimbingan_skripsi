<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pengajuan_juduls', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mahasiswa_id')->constrained()->cascadeOnDelete();
        
        $table->string('judul_1');
        $table->text('deskripsi_1');
        
        $table->string('judul_2');
        $table->text('deskripsi_2');

        $table->string('judul_3');
        $table->text('deskripsi_3');

        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->integer('judul_diterima')->nullable(); // (akan diisi 1, 2, atau 3)
        $table->text('catatan_admin')->nullable(); // (jika ditolak)
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_juduls');
    }
};
