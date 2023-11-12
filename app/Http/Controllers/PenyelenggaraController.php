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
        // return response()->json(['penyelenggaras' => $penyelenggaras]);
        return View::make('dashboard.penyelenggara', ['penyelenggaras' => $penyelenggaras]);
    }

    public function create()
    {
        return View::make('dashboard.penyelenggara');
    }

    public function store(Request $request)
    {
        try {

            $data = $request->validate([
                'nama_penyelenggara' => 'required',
                'no_telp' => 'required',
            ]);

            Penyelenggara::create($data);

            return redirect('/dashboard/penyelenggara')->with('status', 'Penyelenggara berhasil ditambahkan.');
        } catch (\Exception) {
            return redirect('/dashboard/penyelenggara')->with('error', 'Terjadi kesalahan saat menambahkan Penyelenggara.');
        }
    }

    public function show($id)
    {
        try {
            $penyelenggara = Penyelenggara::findOrFail($id);

            info('Penyelenggara found: ' . json_encode($penyelenggara));

            return response()->json(['penyelenggara' => $penyelenggara], 200);
        } catch (\Exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->input('id');
            $penyelenggara = Penyelenggara::find($id);
            $penyelenggara->nama_penyelenggara = $request->input('nama_penyelenggara') ?? $penyelenggara->nama_penyelenggara;
            $penyelenggara->no_telp = $request->input('no_telp') ?? $penyelenggara->no_telp;

            $penyelenggara->update();

            return redirect()->back()->with('status', 'Data penyelenggara berhasil diperbarui.');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Penyelenggara.');
        }
    }

    public function edit($id)
    {
        $penyelenggara = Penyelenggara::find($id);

        if (!$penyelenggara) {
            return response()->json(['error' => 'Penyelenggara not found'], 404);
        }

        return response()->json(['penyelenggara' => $penyelenggara], 200);
    }

    public function destroy($id)
    {
        try {
            $penyelenggara = Penyelenggara::findOrFail($id);
            $penyelenggara->delete();
            info('penyelenggara found: ' . json_encode($penyelenggara));

            return response()->json(['penyelenggara' => $penyelenggara], 200);
        } catch (\Exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
