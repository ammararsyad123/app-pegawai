<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function up(): void
    {
            Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan', 100);
            $table->decimal('gaji_pokok', 10, 2);
            $table->timestamps();
        });
    }
}
