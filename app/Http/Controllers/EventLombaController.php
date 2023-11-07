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
        return view('dashboard.events', ['events' => $events]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lomba' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'kuota' => 'required',
            'penyelenggara_id' => 'required',
        ]);

        $validatedData['tanggal_pendaftaran'] = date("Y-m-d", strtotime($request->tanggal_pendaftaran));
        $validatedData['tanggal_penutupan_pendaftaran'] = date("Y-m-d", strtotime($request->tanggal_penutupan_pendaftaran));
        $validatedData['tanggal_pelaksanaan'] = date("Y-m-d", strtotime($request->tanggal_pelaksanaan));

        EventLomba::create([
            'nama_lomba' => $validatedData['nama_lomba'],
            'deskripsi' => $validatedData['deskripsi'],
            'tempat' => $validatedData['tempat'],
            'tanggal_pendaftaran' => $validatedData['tanggal_pendaftaran'],
            'tanggal_penutupan_pendaftaran' => $validatedData['tanggal_penutupan_pendaftaran'],
            'tanggal_pelaksanaan' => $validatedData['tanggal_pelaksanaan'],
            'kuota' => $validatedData['kuota'],
            'penyelenggara_id' => $validatedData['penyelenggara_id'],
        ]);

        return redirect()->route('dashboard.events')->with('success', 'Success Tambah Data');
    }

    public function show($id)
    {
        $event = EventLomba::find($id);
        return view('dashboard.events', compact('event'));
    }

    public function edit($id)
    {
        $event = EventLomba::find($id);
        if (!$event) {
            return redirect()->route('dashboard.events')->with('error', 'Event not found');
        }

        return view('dashboard.events', compact('event'));
    }


    public function update(Request $request, $id)
    {
        $event = EventLomba::find($id);
        $event->nama_lomba = $request->input('nama_lomba');
        $event->deskripsi = $request->input('deskripsi');
        $event->tempat = $request->input('tempat');
        $event->kuota = $request->input('kuota');
        $event->penyelenggara_id = $request->input('penyelenggara_id');
        $event->tanggal_pendaftaran = date("Y-m-d", strtotime($request->tanggal_pendaftaran));
        $event->tanggal_penutupan_pendaftaran = date("Y-m-d", strtotime($request->tanggal_penutupan_pendaftaran));
        $event->tanggal_pelaksanaan = date("Y-m-d", strtotime($request->tanggal_pelaksanaan));

        $event->update();

        return redirect()->route('dashboard.events')->with('success', 'Data event berhasil diperbarui.');
    }


    public function destroy($id)
    {
        EventLomba::find($id)->delete();

        return redirect()->route('dashboard.events')->with('success', 'Data event berhasil dihapus.');
    }
}
