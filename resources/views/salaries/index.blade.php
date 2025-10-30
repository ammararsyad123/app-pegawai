@extends('master')

@section('title', 'Data Gaji')

@section('header-actions')
    <a href="{{ route('salaries.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Data
    </a>
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        {{-- 1. UBAH JUDUL KOLOM --}}
                        <th>Nama Karyawan</th>
                        <th>Bulan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($salaries as $salary)
                    <tr>
                        {{-- 2. TAMPILKAN NAMA (dari relasi 'employee') --}}
                        <td>
                            {{ $salary->employee?->nama_lengkap ?? 'Karyawan Dihapus' }}
                        </td>
                        <td>{{ $salary->bulan }}</td>
                        
                        {{-- 3. FORMAT ANGKA MENJADI RUPIAH --}}
                        <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                        <td class="fw-bold">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                        
                        <td>
                            {{-- (Kode aksi Anda) --}}
                            <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline-block">
                                <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
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
                        {{-- 4. SESUAIKAN COLSPAN --}}
                        <td colspan="7" class="text-center py-4">
                            Data gaji masih kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $salaries->links() }}
        </div>

    </div>
</div>
@endsection