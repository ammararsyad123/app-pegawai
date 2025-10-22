<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    public function up(): void
        {
                Schema::create('departments', function (Blueprint $table) {
                $table->id();
                $table->string('nama_departemen', 100);
                $table->timestamps();
            });
        }

}

