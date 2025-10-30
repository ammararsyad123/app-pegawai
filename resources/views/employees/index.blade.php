@extends('master')

{{-- 1. Judul Halaman (akan muncul di header kanan) --}}
@section('title', 'Data Pegawai')

{{-- 2. Tombol Aksi di Header (Tombol "Tambah Data") --}}
@section('header-actions')
    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Data
    </a>
@endsection

{{-- 3. Konten Utama (Tabel) --}}
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead> {{-- Header tabel sengaja dibuat terang agar kontras --}}
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Status</th>
                        <th style="width: 150px;">Aksi</th> {{-- Lebar aksi disesuaikan sedikit --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $emp)
                    <tr>
                        <td>{{ $emp->nama_lengkap }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>{{ $emp->nomor_telepon }}</td>
                        <td>
                            {{-- Ganti badge agar sesuai warna Bootstrap 5 baru --}}
                            @if($emp->status == 'aktif')
                                <span class="badge text-bg-success">Aktif</span>
                            @else
                                <span class="badge text-bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            {{-- Rapikan tombol aksi dan tambahkan icon --}}
                            <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" class="d-inline-block">
                                {{-- Tombol Detail --}}
                                <a href="{{ route('employees.show', $emp->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                {{-- Tombol Edit --}}
                                <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                {{-- Tombol Hapus --}}
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Tambahkan padding agar lebih rapi --}}
                        <td colspan="5" class="text-center py-4">
                            Data pegawai masih kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination diberi margin atas --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection

