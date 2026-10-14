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
    Schema::create('catatan_bimbingans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bimbingan_request_id')->constrained()->cascadeOnDelete();
        $table->text('catatan_dosen');
        $table->string('file_revisi_mahasiswa')->nullable();
        $table->dateTime('tanggal_bimbingan');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_bimbingans');
    }
};
