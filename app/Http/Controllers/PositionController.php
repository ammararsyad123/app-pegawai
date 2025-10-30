<?php

namespace App\Http\Controllers;

use App\Models\Position; 
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->paginate(5); 
        return view('positions.index', compact('positions')); 
    }

    public function create()
    {
        return view('positions.create'); 
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric',
        ]);

        Position::create($request->all()); 

        return redirect()->route('positions.index') 
                         ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function show(Position $position) 
    {
        return view('positions.show', compact('position')); 
    }

    public function edit(Position $position) 
    {
        return view('positions.edit', compact('position')); 
    }

    public function update(Request $request, Position $position) 
    {

        $request->validate([
            'nama_jabatan' => 'required|string|max:100',
            'gaji_pokok' => 'required|numeric',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index') 
                         ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index') 
                         ->with('success', 'Jabatan berhasil dihapus.');
    }
}
