@extends('master')

@section('title', 'Tambah Data Absensi')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Tambah Absensi</h1>
        <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('attendance.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                            <select id="karyawan_id" name="karyawan_id" class="form-select @error('karyawan_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Karyawan --</option>
                                
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->nama_lengkap }}
                                    </option>
                                @endforeach

                            </select>
                            @error('karyawan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" 
                                   class="form-control @error('tanggal') is-invalid @enderror" 
                                   value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status_absensi" class="form-label">Status Absensi</label>
                            <select name="status_absensi" id="status_absensi" class="form-select @error('status_absensi') is-invalid @enderror">
                                <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                                <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                            </select>
                            @error('status_absensi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                            <input type="time" id="waktu_masuk" name="waktu_masuk" 
                                   class="form-control @error('waktu_masuk') is-invalid @enderror" 
                                   value="{{ old('waktu_masuk') }}">
                            @error('waktu_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                            <input type="time" id="waktu_keluar" name="waktu_keluar" 
                                   class="form-control @error('waktu_keluar') is-invalid @enderror" 
                                   value="{{ old('waktu_keluar') }}">
                            @error('waktu_keluar')
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

{{-- ========================================================== --}}
{{-- TAMBAHKAN KODE INI DI PALING BAWAH --}}
{{-- ========================================================== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Ambil elemen-elemen yang kita butuhkan
        const statusSelect = document.getElementById('status_absensi');
        const waktuMasukInput = document.getElementById('waktu_masuk');
        const waktuKeluarInput = document.getElementById('waktu_keluar');

        // Buat fungsi untuk mengecek status
        function toggleTimeInputs() {
            const status = statusSelect.value;
            
            // Jika status BUKAN 'hadir'
            if (status !== 'hadir') {
                // Nonaktifkan field
                waktuMasukInput.disabled = true;
                waktuKeluarInput.disabled = true;
                
                // Kosongkan nilainya
                waktuMasukInput.value = '';
                waktuKeluarInput.value = '';
            } else {
                // Jika 'hadir', aktifkan kembali
                waktuMasukInput.disabled = false;
                waktuKeluarInput.disabled = false;
            }
        }

        // Jalankan fungsi saat ada perubahan pada dropdown
        statusSelect.addEventListener('change', toggleTimeInputs);
        
        // Jalankan fungsi saat halaman pertama kali dimuat
        toggleTimeInputs();
    });
</script>