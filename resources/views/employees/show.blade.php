@extends('master')

@section('title', '')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pegawai</h1>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light py-3">
            <h6 class="m-0 fw-bold text-primary">Informasi Lengkap Pegawai</h6>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th style="width: 30%;">Nama Lengkap</th>
                    <td>: {{ $employee->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: {{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>: {{ $employee->nomor_telepon }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>: {{ $employee->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: {{ $employee->alamat }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>: {{ $employee->tanggal_masuk }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: <span class="badge bg-success text-capitalize">{{ $employee->status }}</span></td>
                </tr>
            </table>
        </div>
    </div>
@endsection