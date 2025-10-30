<?php

namespace App\Http\Controllers;

use App\Models\Position; // <-- Ganti Model
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->paginate(5); // <-- Ganti Model & Variabel
        return view('positions.index', compact('positions')); // <-- Ganti View & Variabel
    }

    public function create()
    {
        return view('positions.create'); // <-- Ganti View
    }

    public function store(Request $request)
    {
        // Sesuaikan validasi
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric',
        ]);

        Position::create($request->all()); // <-- Ganti Model

        return redirect()->route('positions.index') // <-- Ganti Route
                         ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function show(Position $position) // <-- Ganti Model & Variabel
    {
        return view('positions.show', compact('position')); // <-- Ganti View & Variabel
    }

    public function edit(Position $position) // <-- Ganti Model & Variabel
    {
        return view('positions.edit', compact('position')); // <-- Ganti View & Variabel
    }

    public function update(Request $request, Position $position) // <-- Ganti Model & Variabel
    {
        // Sesuaikan validasi
        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index') // <-- Ganti Route
                         ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position) // <-- Ganti Model & Variabel
    {
        $position->delete();

        return redirect()->route('positions.index') // <-- Ganti Route
                         ->with('success', 'Jabatan berhasil dihapus.');
    }
}
