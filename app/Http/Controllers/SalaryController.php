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

    /**
     * Store a newly created resource in storage.
     *
     * 1. METHOD INI TELAH DIREVISI
     */
    public function store(Request $request)
    {
        // Validasi dan AMBIL datanya
        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id', 
            'bulan' => 'required|date_format:Y-m', 
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'total_gaji' => 'required|numeric',
        ]);

        // JANGAN PAKAI $request->all()
        // Atur nilai default 0 untuk field nullable jika kosong
        $validatedData['tunjangan'] = $validatedData['tunjangan'] ?? 0;
        $validatedData['potongan'] = $validatedData['potongan'] ?? 0;

        // Simpan data yang sudah bersih
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

    /**
     * Update the specified resource in storage.
     *
     * 2. METHOD INI TELAH DIREVISI (INI YANG ERROR DI SCREENSHOT)
     */
    public function update(Request $request, Salary $salary)
    {
        // Validasi dan AMBIL datanya
        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|date_format:Y-m',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'total_gaji' => 'required|numeric',
        ]);

        // JANGAN PAKAI $request->all()
        // Atur nilai default 0 untuk field nullable jika kosong
        $validatedData['tunjangan'] = $validatedData['tunjangan'] ?? 0;
        $validatedData['potongan'] = $validatedData['potongan'] ?? 0;

        // Update data yang sudah bersih
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
    
    /**
     * Method AJAX (Ini sudah benar)
     */
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