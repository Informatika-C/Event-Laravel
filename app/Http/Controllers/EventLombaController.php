<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventLomba;

class EventLombaController extends Controller
{

    public function index()
    {
        $events = EventLomba::all();
        return view('dashboard.events', compact('events'));
    }
    public function create()
    {
        return view('events.create');
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

        return redirect()->route('events.create')->with('success', 'Data event berhasil disimpan.');
    }

    public function show($id)
    {
        $event = EventLomba::find($id);
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = EventLomba::find($id);
        return view('events.edit', compact('event'));
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

        return redirect()->route('events.edit', $id)->with('success', 'Data event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        EventLomba::find($id)->delete();

        return redirect()->route('events.index')->with('success', 'Data event berhasil dihapus.');
    }
}
