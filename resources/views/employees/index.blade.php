@extends('layout')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Pegawai</h4>
        {{-- Tombol Tambah Data dengan style --}}
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{-- Tabel dengan style Bootstrap --}}
            <table class="table table-striped table-hover">
                {{-- Header tabel dengan latar belakang gelap --}}
                <thead class="table-dark">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Status</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Menggunakan @forelse agar lebih ringkas --}}
                    @forelse($employees as $emp)
                    <tr>
                        <td>{{ $emp->nama_lengkap }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>{{ $emp->nomor_telepon }}</td>
                        <td>
                            {{-- Status dengan badge berwarna --}}
                            @if($emp->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            {{-- Tombol-tombol aksi dengan style --}}
                            <form action="{{ route('employees.destroy', $emp->id) }}" method="POST">
                                <a href="{{ route('employees.show', $emp->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Data pegawai masih kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Link Pagination dengan Style Bootstrap --}}
        <div class="d-flex justify-content-center">
            {{ $employees->links() }}
        </div>

    </div>
</div>
@endsection