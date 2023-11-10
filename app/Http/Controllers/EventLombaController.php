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
        $events = EventLomba::with('penyelenggara')->get();
        return view('dashboard.events', ['events' => $events]);
    }
    public function create()
    {
        $penyelenggaras = Penyelenggara::all();
        return view('dashboard.events', ['penyelenggaras' => $penyelenggaras]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lomba' => 'required',
            'deskripsi' => 'required',
            'tempat' => 'required',
            'kuota' => 'required',
            'penyelenggara_id' => 'required|exists:penyelenggaras,id',
            // 'penyelenggara_id' => 'required',
        ], [
            'penyelenggara_id.exists' => 'Pilih Penyelenggara yang valid.',
        ]);

        $validatedData['tanggal_pendaftaran'] = date("Y-m-d", strtotime($request->tanggal_pendaftaran));
        $validatedData['tanggal_penutupan_pendaftaran'] = date("Y-m-d", strtotime($request->tanggal_penutupan_pendaftaran));
        $validatedData['tanggal_pelaksanaan'] = date("Y-m-d", strtotime($request->tanggal_pelaksanaan));


        try {
            $event = new EventLomba;

            $event->nama_lomba = $validatedData['nama_lomba'];
            $event->deskripsi = $validatedData['deskripsi'];
            $event->tempat = $validatedData['tempat'];
            $event->kuota = $validatedData['kuota'];
            $event->tanggal_pendaftaran = $validatedData['tanggal_pendaftaran'];
            $event->tanggal_penutupan_pendaftaran = $validatedData['tanggal_penutupan_pendaftaran'];
            $event->tanggal_pelaksanaan = $validatedData['tanggal_pelaksanaan'];
            $event->penyelenggara_id = $validatedData['penyelenggara_id'];

            $event->save();

            return redirect('/dashboard/events')->with('status', 'Event berhasil ditambahkan.');
        } catch (\Exception) {
            return redirect('/dashboard/events')->with('error', 'Terjadi kesalahan saat menambahkan event.');
        }
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
        $event = EventLomba::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json(['event' => $event], 200);
    }


    public function destroy(Request $request)
    {
        try {
            $id = $request->input('del_id');
            $event = EventLomba::find($id);
            $event->nama_lomba = $request->input('nama_lomba');

            $event->delete();

            return redirect('/dashboard/events')->with('success', 'Data event berhasil dihapus.');
        } catch (\Exception) {
            return redirect('/dashboard/events')->with('error', 'Terjadi kesalahan saat menghapus event.');
        }
    }
}
