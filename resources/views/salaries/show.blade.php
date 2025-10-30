@extends('master')

@section('title', '')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Gaji</h1>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light py-3">
            <h6 class="m-0 fw-bold text-primary">Informasi Gaji</h6>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 30%;">Nama Karyawan</th>
                    <td>: {{ $salary->employee?->nama_lengkap ?? 'Karyawan Dihapus' }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Bulan</th>
                    <td>: {{ $salary->bulan }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Gaji Pokok</th>
                    <td>: Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Tunjangan</th>
                    <td>: Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Potongan</th>
                    <td>: Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Total Gaji</th>
                    <td class="fw-bold">: Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection