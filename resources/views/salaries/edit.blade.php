@extends('master')

@section('title', '')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Gaji</h1>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">

                        {{-- 1. UBAH INPUT ID KARYAWAN MENJADI DROPDOWN --}}
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                            <select id="karyawan_id" name="karyawan_id" class="form-select @error('karyawan_id') is-invalid @enderror" required>
                                <option value="" disabled>-- Pilih Karyawan --</option>
                                
                                {{-- Loop $employees dari Controller (method edit()) --}}
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" 
                                        {{-- Cek 'old' value ATAU data $salary yang ada --}}
                                        {{ old('karyawan_id', $salary->karyawan_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->nama_lengkap }}
                                    </option>
                                @endforeach

                            </select>
                            @error('karyawan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2. UBAH TIPE INPUT 'BULAN' MENJADI 'MONTH' --}}
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan (Contoh: 2025-10)</label>
                            <input type="month" id="bulan" name="bulan" 
                                   class="form-control @error('bulan') is-invalid @enderror" 
                                   value="{{ old('bulan', $salary->bulan) }}" required>
                            @error('bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3. UBAH INPUT 'GAJI POKOK' (TAMBAH 'READONLY') --}}
                        <div class="mb-3">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                            <input type="number" id="gaji_pokok" name="gaji_pokok" 
                                   class="form-control @error('gaji_pokok') is-invalid @enderror" 
                                   value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" required readonly>
                            @error('gaji_pokok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- 4. INPUT 'TUNJANGAN' (Nilai default dari $salary) --}}
                        <div class="mb-3">
                            <label for="tunjangan" class="form-label">Tunjangan</label>
                            <input type="number" id="tunjangan" name="tunjangan" 
                                   class="form-control @error('tunjangan') is-invalid @enderror" 
                                   value="{{ old('tunjangan', $salary->tunjangan ?? 0) }}" required>
                            @error('tunjangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 5. INPUT 'POTONGAN' (Nilai default dari $salary) --}}
                        <div class="mb-3">
                            <label for="potongan" class="form-label">Potongan</label>
                            <input type="number" id="potongan" name="potongan" 
                                   class="form-control @error('potongan') is-invalid @enderror" 
                                   value="{{ old('potongan', $salary->potongan ?? 0) }}" required>
                            @error('potongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        {{-- 6. UBAH TOTAL BLOK 'TOTAL GAJI' --}}
                        <div class="mb-3">
                            <label class="form-label">Total Gaji (Otomatis)</label>
                            {{-- Tampilan <h3> --}}
                            <h3 id="total_gaji_display" class="fw-bold text-success">Rp 0</h3>
                            {{-- Input <hidden> --}}
                            <input type="hidden" id="total_gaji" name="total_gaji" 
                                   value="{{ old('total_gaji', $salary->total_gaji) }}">
                            @error('total_gaji')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>

            </form>
        </div>
    </div>
@endsection

{{-- 7. TAMBAHKAN SCRIPT AJAX + KALKULATOR (Sama seperti 'create.blade.php') --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Ambil semua elemen input
        const karyawanSelect = document.getElementById('karyawan_id');
        const gajiPokokInput = document.getElementById('gaji_pokok');
        const tunjanganInput = document.getElementById('tunjangan');
        const potonganInput = document.getElementById('potongan');
        const totalGajiInput = document.getElementById('total_gaji');
        const totalGajiDisplay = document.getElementById('total_gaji_display');

        // --- Fitur 1: Ambil Gaji Pokok (AJAX) ---
        karyawanSelect.addEventListener('change', function() {
            const employeeId = this.value;

            if (!employeeId) {
                gajiPokokInput.value = 0;
                hitungTotal();
                return;
            }

            const url = '{{ route("salaries.getEmployeeSalary", ["employee" => ":id"]) }}'.replace(':id', employeeId);

            fetch(url)
                .then(response => response.json())
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

        // --- Fitur 2: Kalkulator Total Gaji ---
        tunjanganInput.addEventListener('input', hitungTotal);
        potonganInput.addEventListener('input', hitungTotal);

        // Fungsi utama kalkulator
        function hitungTotal() {
            const pokok = parseFloat(gajiPokokInput.value) || 0;
            const tunjangan = parseFloat(tunjanganInput.value) || 0;
            const potongan = parseFloat(potonganInput.value) || 0;

            const total = pokok + tunjangan - potongan;

            // Update input hidden
            totalGajiInput.value = total;

            // Update tampilan
            totalGajiDisplay.innerText = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(total);
        }

        // PENTING: Panggil 'hitungTotal()' saat halaman 'edit' pertama kali dimuat
        // Ini akan langsung menghitung total gaji berdasarkan data yang ada
        hitungTotal(); 
    });
</script>
@endpush