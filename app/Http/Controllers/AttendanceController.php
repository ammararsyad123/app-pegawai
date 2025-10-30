<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
//test
class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(5);
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get(); 
        return view('attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',


            'waktu_masuk' => 'required_if:status_absensi,hadir|nullable|date_format:H:i',
            'waktu_keluar' => 'required_if:status_absensi,hadir|nullable|date_format:H:i',

            'status_absensi' => 'required|in:hadir,sakit,izin,alpha',
        ]);


        $dataToCreate = [
            'karyawan_id' => $validatedData['karyawan_id'],
            'tanggal' => $validatedData['tanggal'],
            'status_absensi' => $validatedData['status_absensi'],
            'waktu_masuk' => null,
            'waktu_keluar' => null,
        ];

        if (!empty($validatedData['waktu_masuk'])) {
            $dataToCreate['waktu_masuk'] = Carbon::parse($validatedData['tanggal'] . ' ' . $validatedData['waktu_masuk']);
        }

        if (!empty($validatedData['waktu_keluar'])) {
            $datetime_keluar = Carbon::parse($validatedData['tanggal'] . ' ' . $validatedData['waktu_keluar']);

            if ($dataToCreate['waktu_masuk'] && $datetime_keluar->lt($dataToCreate['waktu_masuk'])) {
                $datetime_keluar->addDay();
            }
            $dataToCreate['waktu_keluar'] = $datetime_keluar;
        }

        Attendance::create($dataToCreate);

        return redirect()->route('attendance.index')
                         ->with('success', 'Absensi berhasil ditambahkan.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('nama_lengkap')->get(); 
        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {

        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',

            
            'waktu_masuk' => 'required_if:status_absensi,hadir|nullable|date_format:H:i',
            'waktu_keluar' => 'required_if:status_absensi,hadir|nullable|date_format:H:i',

            'status_absensi' => 'required|in:hadir,sakit,izin,alpha',
        ]);


        $dataToUpdate = [
            'karyawan_id' => $validatedData['karyawan_id'],
            'tanggal' => $validatedData['tanggal'],
            'status_absensi' => $validatedData['status_absensi'],
            'waktu_masuk' => null,
            'waktu_keluar' => null,
        ];

        if (!empty($validatedData['waktu_masuk'])) {
            $dataToUpdate['waktu_masuk'] = Carbon::parse($validatedData['tanggal'] . ' ' . $validatedData['waktu_masuk']);
        }

        if (!empty($validatedData['waktu_keluar'])) {
            $datetime_keluar = Carbon::parse($validatedData['tanggal'] . ' ' . $validatedData['waktu_keluar']);
            if ($dataToUpdate['waktu_masuk'] && $datetime_keluar->lt($dataToUpdate['waktu_masuk'])) {
                $datetime_keluar->addDay();
            }
            $dataToUpdate['waktu_keluar'] = $datetime_keluar;
        }

        $attendance->update($dataToUpdate);

        return redirect()->route('attendance.index')
                         ->with('success', 'Absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')
                         ->with('success', 'Absensi berhasil dihapus.');
    }
}