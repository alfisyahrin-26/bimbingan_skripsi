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
    Schema::create('bimbingan_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bimbingan_id')->constrained()->cascadeOnDelete();
        $table->string('topik');
        $table->text('deskripsi');
        $table->dateTime('tanggal_diajukan');
        
        $table->enum('status', ['pending', 'approved', 'rejected', 'reschedule'])->default('pending');
        
        // Untuk Dosen
        $table->dateTime('tanggal_balasan')->nullable(); // Kapan dosen merespon
        $table->dateTime('tanggal_direvisi')->nullable(); // Jika status reschedule
        $table->text('alasan_penolakan')->nullable(); // Jika status rejected
        
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan_requests');
    }
};
