<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department; 
use App\Models\Position;   
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::latest()->paginate(5);
        return view('employees.index', compact('employees'));
    }


    public function create()
    {

        $departments = Department::all();
        $positions = Position::all();
        

        return view('employees.create', compact('departments', 'positions'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string',
            'departemen_id' => 'required|exists:departments,id', 
            'jabatan_id'    => 'required|exists:positions,id',    
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }


    public function show(Employee $employee)
    {

        return view('employees.show', compact('employee'));
    }


    public function edit(Employee $employee)
    {




        $departments = Department::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }


    public function update(Request $request, Employee $employee)
    {

        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:employees,email,' . $employee->id, 
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id'    => 'required|exists:positions,id',   
        ]);

        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }


    public function destroy(Employee $employee)
    {

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
