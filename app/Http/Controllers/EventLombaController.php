<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventLomba;
use App\Models\Penyelenggara;
use Illuminate\Support\Facades\DB;

class EventLombaController extends Controller
{
    public function index()
    {
        $penyelenggaras = Penyelenggara::all();
        $events = EventLomba::with('penyelenggara')->get();
        return view('dashboard.events', compact('events', 'penyelenggaras'));
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
            'kuota' => 'required',
            'penyelenggara_id' => 'required|exists:penyelenggara,id',
        ], [
            'penyelenggara_id.exists' => 'Pilih Penyelenggara yang valid.',
        ]);
        $validatedData['tanggal_pendaftaran'] = date("Y-m-d", strtotime($request->tanggal_pendaftaran));
        $validatedData['tanggal_penutupan_pendaftaran'] = date("Y-m-d", strtotime($request->tanggal_penutupan_pendaftaran));
        $validatedData['tanggal_pelaksanaan'] = date("Y-m-d", strtotime($request->tanggal_pelaksanaan));

        EventLomba::create($validatedData);

        return redirect('/dashboard/events')->with('status', 'Event berhasil ditambahkan.');
    }

    public function show($id)
    {
        try {
            $event = EventLomba::findOrFail($id);

            info('Event found: ' . json_encode($event));

            return response()->json(['event' => $event], 200);
        } catch (\Exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->input('id');
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


            return redirect()->back()->with('success', 'Data event berhasil diperbarui.');
        } catch (\Exception) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat update event.');
        }
    }

    public function edit($id)
    {
        $event = EventLomba::with('penyelenggara')->find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $penyelenggaras = Penyelenggara::all();

        return response()->json([
            'event' => $event,
            'penyelenggaras' => $penyelenggaras,
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $event = EventLomba::findOrFail($id);
            $event->delete();
            info('Event found: ' . json_encode($event));

            return response()->json(['event' => $event], 200);
        } catch (\Exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
