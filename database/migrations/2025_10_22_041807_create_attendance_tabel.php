<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->date('tanggal');
            

            $table->datetime('waktu_masuk')->nullable(); 
            
            $table->datetime('waktu_keluar')->nullable(); 
            $table->enum('status_absensi', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->timestamps();
            

            $table->foreign('karyawan_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }


    public function down(): void
    {
        
        Schema::dropIfExists('attendance');
    }
};