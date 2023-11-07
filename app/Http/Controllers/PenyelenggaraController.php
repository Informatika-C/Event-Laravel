<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Penyelenggara;

class PenyelenggaraController extends Controller
{
    public function index()
    {
        $penyelenggaras = Penyelenggara::all();

        return View::make('dashboard.penyelenggara')->with('penyelenggaras', $penyelenggaras);
    }
    public function create()
    {
        return View::make('dashboard.penyelenggara');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_penyelenggara' => 'required',
            'no_telp' => 'required',
        ]);

        Penyelenggara::create($data);

        return redirect()->route('dashboard.penyelenggara')->with('success', 'Penyelenggara berhasil ditambahkan.');
    }

    public function show(Penyelenggara $penyelenggara)
    {
        return View::make('dashboard.penyelenggara')->with('penyelenggara', $penyelenggara);
        // return View::make('dashboard.penyelenggara', compact('penyelenggara'));
    }


    public function update(Request $request, Penyelenggara $penyelenggara)
    {
        $validatedData = $request->validate([
            'nama_penyelenggara' => 'required',
            'no_telp' => 'required',
        ]);

        $penyelenggara->update($validatedData);

        return redirect()->route('dashboard.penyelenggara')->with('success', 'Data penyelenggara berhasil diperbarui.');
    }

    // public function edit($id)
    // {
    //     $penyelenggara = Penyelenggara::find($id);

    //     return View::make('dashboard.penyelenggara')->with('penyelenggara', $penyelenggara);
    //     // return View::make('dashboard.penyelenggara.edit', compact('penyelenggara'));
    // }


    // public function destroy(Penyelenggara $penyelenggara)
    // {
    //     $penyelenggara->delete();

    //     return redirect()->route('dashboard.penyelenggara')->with('success', 'Data event berhasil dihapus.');
    // }
}