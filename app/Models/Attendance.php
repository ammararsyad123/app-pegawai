<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * (Ini sudah benar, karena nama tabel Anda 'attendance' bukan 'attendances')
     *
     * @var string
     */
    protected $table = 'attendance';

    /**
     * The attributes that are mass assignable.
     * (Ini $fillable Anda, sudah benar)
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
    ];

    public function employee()
    {
        // 'karyawan_id' adalah foreign key di tabel ini (attendance)
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }

    /**
     * 2. TAMBAHKAN $casts INI
     *
     * Otomatis mengubah kolom ini menjadi objek Carbon (objek tanggal/waktu).
     * Ini memungkinkan kita menggunakan format('H:i') di view.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];
}