@extends('master')

@section('title', '')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Tambah Gaji</h1>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('salaries.store') }}" method="POST">
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
                            <label for="bulan" class="form-label">Bulan (Contoh: 2025-10)</label>
                            <input type="month" id="bulan" name="bulan" 
                                   class="form-control @error('bulan') is-invalid @enderror" 
                                   value="{{ old('bulan') }}" required>
                            @error('bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                            <input type="number" id="gaji_pokok" name="gaji_pokok" 
                                   class="form-control @error('gaji_pokok') is-invalid @enderror" 
                                   value="{{ old('gaji_pokok', 0) }}" required 
                                   readonly> 
                            @error('gaji_pokok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tunjangan" class="form-label">Tunjangan</label>
                            <input type="number" id="tunjangan" name="tunjangan" 
                                   class="form-control @error('tunjangan') is-invalid @enderror" 
                                   value="{{ old('tunjangan', 0) }}" required>
                            @error('tunjangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="potongan" class.form-label">Potongan</label>
                            <input type="number" id="potongan" name="potongan" 
                                   class="form-control @error('potongan') is-invalid @enderror" 
                                   value="{{ old('potongan', 0) }}" required>
                            @error('potongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Total Gaji (Otomatis)</label>
                            <h3 id="total_gaji_display" class="fw-bold text-success">Rp 0</h3>
                            <input type="hidden" id="total_gaji" name="total_gaji" value="{{ old('total_gaji', 0) }}">
                            @error('total_gaji')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const karyawanSelect = document.getElementById('karyawan_id');
        const gajiPokokInput = document.getElementById('gaji_pokok');
        const tunjanganInput = document.getElementById('tunjangan');
        const potonganInput = document.getElementById('potongan');
        const totalGajiInput = document.getElementById('total_gaji'); 
        const totalGajiDisplay = document.getElementById('total_gaji_display'); 

        karyawanSelect.addEventListener('change', function() {
            const employeeId = this.value;

            if (!employeeId) {
                gajiPokokInput.value = 0;
                hitungTotal();
                return;
            }

            const url = '{{ route("salaries.getEmployeeSalary", ["employee" => ":id"]) }}'.replace(':id', employeeId);

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Karyawan tidak ditemukan atau tidak punya jabatan.');
                    }
                    return response.json();
                })
                .then(data => {
                    gajiPokokInput.value = data.gaji_pokok;
                    hitungTotal(); 
                })
                .catch(error => {
                    console.error('Error:', error);
                    gajiPokokInput.value = 0;
                    hitungTotal();
                });
        });

        tunjanganInput.addEventListener('input', hitungTotal);
        potonganInput.addEventListener('input', hitungTotal);

        function hitungTotal() {
            const pokok = parseFloat(gajiPokokInput.value) || 0;
            const tunjangan = parseFloat(tunjanganInput.value) || 0;
            const potongan = parseFloat(potonganInput.value) || 0;

            const total = pokok + tunjangan - potongan;

            totalGajiInput.value = total;

            totalGajiDisplay.innerText = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(total);
        }

        hitungTotal(); 
    });
</script>
@endpush