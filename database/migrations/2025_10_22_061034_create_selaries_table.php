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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->string('bulan', 10);
            
            // 1. UBAH SEMUA KOLOM DECIMAL INI
            // 'decimal(15, 2)' bisa menyimpan hingga 999 Triliun
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('tunjangan', 15, 2)->default(0);
            $table->decimal('potongan', 15, 2)->default(0);
            $table->decimal('total_gaji', 15, 2);
            
            $table->timestamps();
            
            // Relasi (Sudah Benar)
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
        // 2. PERBAIKI TYPO INI (dari 'selaries' menjadi 'salaries')
        Schema::dropIfExists('salaries');
    }
};