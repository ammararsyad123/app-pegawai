@extends('master')

@section('title', 'Detail Absensi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Absensi</h1>
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light py-3">
            <h6 class="m-0 fw-bold text-primary">Informasi Absensi</h6>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 30%;">Nama Karyawan</th>
                    <td>: {{ $attendance->employee?->nama_lengkap ?? 'Karyawan Dihapus' }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Tanggal</th>
                    <td>: {{ $attendance->tanggal->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Waktu Masuk</th>
                    <td>: {{ $attendance->waktu_masuk ? $attendance->waktu_masuk->format('H:i') . ' WIB' : '-' }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Waktu Keluar</th>
                    <td>: {{ $attendance->waktu_keluar ? $attendance->waktu_keluar->format('H:i') . ' WIB' : '-' }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Status Absensi</th>
                    <td>:
                        <span class="badge 
                            @if($attendance->status_absensi == 'hadir') text-bg-success 
                            @elseif($attendance->status_absensi == 'sakit') text-bg-warning 
                            @elseif($attendance->status_absensi == 'izin') text-bg-info 
                            @else text-bg-danger @endif">
                            {{ $attendance->status_absensi }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection