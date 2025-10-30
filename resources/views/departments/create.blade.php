@extends('master')

@section('title', 'Tambah Data Departemen')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Tambah Departemen</h1>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- Kita hanya butuh satu field --}}
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nama_departemen" class="form-label">Nama Departemen</label>
                            <input type="text" id="nama_departemen" name="nama_departemen" 
                                   class="form-control @error('nama_departemen') is-invalid @enderror" 
                                   value="{{ old('nama_departemen') }}" required>
                            @error('nama_departemen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
@endsection