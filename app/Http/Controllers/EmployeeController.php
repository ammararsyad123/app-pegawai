<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department; // <-- 1. TAMBAHKAN IMPORT INI
use App\Models\Position;   // <-- 1. TAMBAHKAN IMPORT INI
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 2. UBAH FUNGSI INI
        // Ambil data untuk dropdown
        $departments = Department::all();
        $positions = Position::all();
        
        // Kirim data tsb ke view
        return view('employees.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 3. TAMBAHKAN VALIDASI UNTUK ID
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string',
            'departemen_id' => 'required|exists:departments,id', // <-- TAMBAHKAN INI
            'jabatan_id'    => 'required|exists:positions,id',    // <-- TAMBAHKAN INI
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    // Saya ubah (string $id) menjadi (Employee $employee) (Ini best practice Laravel)
    public function show(Employee $employee)
    {
        // $employee = Employee::findOrFail($id); // <-- Tidak perlu lagi
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Saya ubah (string $id) menjadi (Employee $employee)
    public function edit(Employee $employee)
    {
        // $employee = Employee::findOrFail($id); // <-- Tidak perlu lagi

        // 4. UBAH FUNGSI INI
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Saya ubah (string $id) menjadi (Employee $employee)
    public function update(Request $request, Employee $employee)
    {
        // 3. TAMBAHKAN VALIDASI UNTUK ID
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees,email,' . $employee->id, // <-- $id diganti $employee->id
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string',
            'departemen_id' => 'required|exists:departments,id', // <-- TAMBAHKAN INI
            'jabatan_id'    => 'required|exists:positions,id',    // <-- TAMBAHKAN INI
        ]);
        
        // $employee = Employee::findOrFail($id); // <-- Tidak perlu lagi
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Saya ubah (string $id) menjadi (Employee $employee)
    public function destroy(Employee $employee)
    {
        // $employee = Employee::findOrFail($id); // <-- Tidak perlu lagi
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
