<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'karyawan_id',
        'bulan',
        'gaji_pokok',
        'tunjangan',
        'potongan',
        'total_gaji',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }

    /**
     * 2. TAMBAHKAN $casts INI (Opsional tapi sangat disarankan)
     *
     * Otomatis mengubah kolom ini menjadi tipe data yang benar.
     * 'decimal:2' akan memformat angka dengan 2 angka di belakang koma.
     */
    protected $casts = [
        'gaji_pokok' => 'decimal:2',
        'tunjangan' => 'decimal:2',
        'potongan' => 'decimal:2',
        'total_gaji' => 'decimal:2',
    ];
}