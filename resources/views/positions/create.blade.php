@extends('master')

@section('title', '')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Tambah Jabatan</h1>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('positions.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                            <input type="text" id="nama_jabatan" name="nama_jabatan" 
                                   class="form-control @error('nama_jabatan') is-invalid @enderror" 
                                   value="{{ old('nama_jabatan') }}" required>
                            @error('nama_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                            <input type="number" id="gaji_pokok" name="gaji_pokok" 
                                   class="form-control @error('gaji_pokok') is-invalid @enderror" 
                                   value="{{ old('gaji_pokok') }}" required step="0.01">
                            @error('gaji_pokok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
@endsection