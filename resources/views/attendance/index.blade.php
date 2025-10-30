@extends('master')

@section('title', 'Data Absensi')

@section('header-actions')
    <a href="{{ route('attendance.create') }}" class="btn btn-primary">
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
                        {{-- KITA UBAH JUDULNYA --}}
                        <th>Nama Karyawan</th>
                        <th>Tanggal</th>
                        <th>Waktu Masuk</th>
                        <th>Waktu Keluar</th>
                        <th>Status</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $att)
                    <tr>
                        {{-- 1. UBAH INI: Tampilkan nama, bukan ID --}}
                        <td>
                            {{-- Kita panggil relasi 'employee' dan kolom 'nama_lengkap' --}}
                            {{-- Tambahkan '?' (optional) jika karyawan mungkin sudah dihapus --}}
                            {{ $att->employee?->nama_lengkap ?? 'Karyawan Dihapus' }}
                        </td>
                        
                        {{-- 2. UBAH INI: Format tanggal --}}
                        <td>
                            {{-- Karena $casts di Model, $att->tanggal sekarang adalah objek Carbon --}}
                            {{ $att->tanggal->format('d/m/Y') }}
                        </td>
                        
                        {{-- 3. UBAH INI: Format waktu masuk --}}
                        <td>
                            {{-- Cek dulu apakah $att->waktu_masuk ada (tidak null) --}}
                            {{ $att->waktu_masuk ? $att->waktu_masuk->format('H:i') : '-' }}
                        </td>
                        
                        {{-- 4. UBAH INI: Format waktu keluar --}}
                        <td>
                            {{ $att->waktu_keluar ? $att->waktu_keluar->format('H:i') : '-' }}
                            {{-- Bonus: Beri tanda jika beda hari --}}
                            @if($att->waktu_keluar && $att->waktu_keluar->isNextDay($att->waktu_masuk))
                                <span class="badge text-bg-secondary ms-1" title="Absen di hari berikutnya">+1</span>
                            @endif
                        </td>

                        <td>
                            {{-- (Kode badge Anda sudah benar) --}}
                            <span class="badge 
                                @if($att->status_absensi == 'hadir') text-bg-success 
                                @elseif($att->status_absensi == 'sakit') text-bg-warning 
                                @elseif($att->status_absensi == 'izin') text-bg-info 
                                @else text-bg-danger @endif">
                                {{ $att->status_absensi }}
                            </span>
                        </td>
                        <td>
                            {{-- (Kode aksi Anda sudah benar) --}}
                            <form action="{{ route('attendance.destroy', $att->id) }}" method="POST" class="d-inline-block">
                                <a href="{{ route('attendance.show', $att->id) }}" class="btn btn-info btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('attendance.edit', $att->id) }}" class="btn btn-warning btn-sm" title="Edit">
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
                        {{-- (Colspan Anda sudah benar) --}}
                        <td colspan="6" class="text-center py-4">
                            Data absensi masih kosong.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $attendances->links() }}
        </div>

    </div>
</div>
@endsection
