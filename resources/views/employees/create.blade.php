@extends('layout')

@section('content')
<h1>Form Tambah Pegawai</h1>

<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    <table cellpadding="5" cellspacing="0">
        <tr>
            <td><label for="nama_lengkap">Nama Lengkap</label></td>
            <td><input type="text" id="nama_lengkap" name="nama_lengkap" required></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" id="email" name="email" required></td>
        </tr>
        <tr>
            <td><label for="nomor_telepon">Nomor Telepon</label></td>
            <td><input type="text" id="nomor_telepon" name="nomor_telepon" required></td>
        </tr>
        <tr>
            <td><label for="tanggal_lahir">Tanggal Lahir</label></td>
            <td><input type="date" id="tanggal_lahir" name="tanggal_lahir" required></td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td><textarea id="alamat" name="alamat" required></textarea></td>
        </tr>
        <tr>
            <td><label for="tanggal_masuk">Tanggal Masuk</label></td>
            <td><input type="date" id="tanggal_masuk" name="tanggal_masuk" required></td>
        </tr>
        <tr>
            <td><label for="status">Status</label></td>
            <td>
                <select id="status" name="status">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;">
                <button type="submit">Simpan</button>
            </td>
        </tr>
    </table>
</form>
@endsection