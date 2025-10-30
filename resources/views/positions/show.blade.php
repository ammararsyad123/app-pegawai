@extends('master')

@section('title', '')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Jabatan</h1>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light py-3">
            <h6 class="m-0 fw-bold text-primary">Informasi Jabatan</h6>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 30%;">Nama Jabatan</th>
                    <td>: {{ $position->nama_jabatan }}</td>
                </tr>
                <tr>
                    <th style="width: 30%;">Gaji Pokok</th>
                    <td>: Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection