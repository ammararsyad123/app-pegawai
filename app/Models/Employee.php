<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id', 
        'jabatan_id',
    ];

    // -----------------------------------------------------------------
    // <-- 2. TAMBAHKAN FUNGSI RELASI INI (PENTING UNTUK AJAX)
    // -----------------------------------------------------------------
    
    /**
     * Mendapatkan data Jabatan (Position) yang dimiliki oleh Karyawan.
     */
    public function position()
    {
        // 'jabatan_id' adalah foreign key di tabel 'employees'
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    /**
     * Mendapatkan data Departemen (Department) yang dimiliki oleh Karyawan.
     */
    public function department()
    {
        // 'departemen_id' adalah foreign key di tabel 'employees'
        return $this->belongsTo(Department::class, 'departemen_id');
    }
}