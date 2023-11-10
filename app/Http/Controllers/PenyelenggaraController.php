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

        return View::make('dashboard.penyelenggara', ['penyelenggaras' => $penyelenggaras]);
    }

    public function create()
    {
        $penyelenggaras = Penyelenggara::all();
        return view('dashboard.events', ['penyelenggaras' => $penyelenggaras]);
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
        $penyelenggara = Penyelenggara::find($id);
        return View::make('dashboard.penyelenggara', ['penyelenggara', $penyelenggara]);
    }

    public function update(Request $request)
    {
        try {


            $id = $request->input('id');
            $penyelenggara = Penyelenggara::find($id);
            $penyelenggara->nama_penyelenggara = $request->input('nama_penyelenggara');
            $penyelenggara->no_telp = $request->input('no_telp');

            $penyelenggara->update();

            return redirect()->back()->with('status', 'Data event berhasil diperbarui.');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Penyelenggara.');
        }
    }

    public function edit($id)
    {
        $penyelenggara = Penyelenggara::find($id);

        if (!$penyelenggara) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json(['penyelenggara' => $penyelenggara], 200);
    }


    public function destroy($id)
    {
        try {
            $penyelenggara = penyelenggara::find($id);
            if (!$penyelenggara) {
                return redirect()->route('dashboard.penyelenggara')->with('error', 'Data tidak ditemukan');
            }

            $penyelenggara->delete();

            return redirect()->back()->with('status', 'Data penyelengara berhasil dihapus.');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
