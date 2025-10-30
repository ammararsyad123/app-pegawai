@extends('master')

{{-- 1. Judul Halaman --}}
@section('title', 'Data Departemen')

{{-- 2. Tombol Aksi di Header --}}
@section('header-actions')
    <a href="{{ route('departments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Data
    </a>
@endsection

{{-- 3. Konten Utama --}}
@section('content')
<div class="card shadow-sm border-0">
    {{-- HAPUS BAGIAN INI: Header lama tidak diperlukan lagi --}}
    {{-- <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Data Departemen</h4>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">
            + Tambah Data
        </a>
    </div> --}}
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                {{-- Hapus class table-dark agar header terang --}}
                <thead>
                    <tr>
                        <th>Nama Departemen</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $dept)
                    <tr>
                        <td>{{ $dept->nama_departemen }}</td>
                        <td>
                            <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" class="d-inline-block">
                                {{-- Tombol Detail --}}
                                <a href="{{ route('departments.show', $dept->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                {{-- Tombol Edit --}}
                                <a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-warning btn-sm" title="Edit">
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
                        {{-- Sesuaikan colspan --}}
                        <td colspan="2" class="text-center py-4">
                            Data departemen masih kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $departments->links() }}
        </div>

    </div>
</div>
@endsection
