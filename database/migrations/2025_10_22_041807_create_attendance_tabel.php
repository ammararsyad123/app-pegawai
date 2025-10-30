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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->date('tanggal');
            
            // ==========================================================
            // PERBAIKAN: Tambahkan ->nullable() di sini
            // ==========================================================
            $table->datetime('waktu_masuk')->nullable(); 
            
            $table->datetime('waktu_keluar')->nullable(); // (Ini sudah benar)
            $table->enum('status_absensi', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('karyawan_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // ==========================================================
        // PERBAIKAN: Perbaiki typo 'attendance_tabel' menjadi 'attendance'
        // ==========================================================
        Schema::dropIfExists('attendance');
    }
};