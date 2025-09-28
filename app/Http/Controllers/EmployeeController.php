<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Diubah menggunakan pagination sesuai modul
        $employees = Employee::latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ditambahkan validasi sesuai modul
        $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:employees',
            'nomor_telepon'   => 'required|string|max:20',
            'tanggal_lahir'   => 'required|date',
            'alamat'          => 'required|string',
            'tanggal_masuk'   => 'required|date',
            'status'          => 'required|string',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Ditambahkan validasi sesuai modul
        $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:employees,email,' . $id,
            'nomor_telepon'   => 'required|string|max:20',
            'tanggal_lahir'   => 'required|date',
            'alamat'          => 'required|string',
            'tanggal_masuk'   => 'required|date',
            'status'          => 'required|string',
        ]);
        
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}