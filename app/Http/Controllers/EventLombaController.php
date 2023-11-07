<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventLomba;
use App\Models\Penyelenggara;

class EventLombaController extends Controller
{
    public function index()
    {
        $events = EventLomba::with('penyelenggara')->get();
        return view('dashboard.events', compact('events'));
    }

    public function create()
    {
        $penyelenggaras = Penyelenggara::all();
        return view('dashboard.events', compact('penyelenggaras'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lomba' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'tanggal_pendaftaran' => 'required|date_format:Y-m-d H:i:s',
            'tanggal_penutupan_pendaftaran' => 'required|date_format:Y-m-d H:i:s',
            'tanggal_pelaksanaan' => 'required|date_format:Y-m-d H:i:s',
            'kuota' => 'required',
            'penyelenggara_id' => 'required',
        ]);

        EventLomba::create($validatedData);

        return redirect()->route('dashboard.events')->with('success', 'Data event berhasil disimpan.');
    }

    public function show($id)
    {
        $event = EventLomba::find($id);
        return view('dashboard.events', compact('event'));
    }

    public function edit($id)
    {
        $event = EventLomba::find($id);
        $penyelenggaras = Penyelenggara::all();
        return view('dashboard.events', compact('event', 'penyelenggaras'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_lomba' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'tanggal_pendaftaran' => 'required|date_format:Y-m-d H:i:s',
            'tanggal_penutupan_pendaftaran' => 'required|date_format:Y-m-d H:i:s',
            'tanggal_pelaksanaan' => 'required|date_format:Y-m-d H:i:s',
            'kuota' => 'required',
            'penyelenggara_id' => 'required',
        ]);

        EventLomba::find($id)->update($validatedData);

        return redirect()->route('dashboard.events')->with('success', 'Data event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        EventLomba::find($id)->delete();

        return redirect()->route('dashboard.events')->with('success', 'Data event berhasil dihapus.');
    }
}