@extends('master')

@section('title', 'Daftar Pegawai')

@section('content')
    <h2>Daftar Pegawai</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            {{-- Asumsikan Anda memiliki variabel $employees dari Controller --}}
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->nama_lengkap }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->nomor_telepon }}</td>
                <td>{{ $employee->tanggal_lahir }}</td>
                <td>{{ $employee->alamat }}</td>
                <td>{{ $employee->tanggal_masuk }}</td>
                <td>{{ $employee->status }}</td>
                <td>
                    <a href="#">Detail</a> |
                    <a href="#">Edit</a> |
                    <form action="#" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection