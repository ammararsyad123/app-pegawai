<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(5);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('salaries.create', compact('employees'));
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id', 
            'bulan' => 'required|date_format:Y-m', 
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'total_gaji' => 'required|numeric',
        ]);


        $validatedData['tunjangan'] = $validatedData['tunjangan'] ?? 0;
        $validatedData['potongan'] = $validatedData['potongan'] ?? 0;


        Salary::create($validatedData);

        return redirect()->route('salaries.index')
                         ->with('success', 'Gaji berhasil ditambahkan.');
    }

    public function show(Salary $salary)
    {
        return view('salaries.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }


    public function update(Request $request, Salary $salary)
    {

        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'total_gaji' => 'required|numeric',
        ]);


        $validatedData['tunjangan'] = $validatedData['tunjangan'] ?? 0;
        $validatedData['potongan'] = $validatedData['potongan'] ?? 0;


        $salary->update($validatedData);

        return redirect()->route('salaries.index')
                         ->with('success', 'Gaji berhasil diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')
                         ->with('success', 'Gaji berhasil dihapus.');
    }
    

    public function getEmployeeSalary(Employee $employee)
    {
        $employee->load('position');

        if ($employee->position) {
            return response()->json([
                'gaji_pokok' => $employee->position->gaji_pokok
            ]);
        }
        return response()->json(['gaji_pokok' => 0]);
    }
}