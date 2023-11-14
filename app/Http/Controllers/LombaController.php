<?php

namespace App\Http\Controllers;

use App\Models\EventLomba;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LombaController extends Controller
{
    public function index(Request $request, $event_id, EventLomba $event)
    {
        $lombas = $event->lombas;
        // $event_id = $request->input('event_id');
        $lombas = $event_id ? Lomba::where('event_id', $event_id)->get() : Lomba::all();
        return view('dashboard.lomba', compact('lombas', 'event_id', 'event'));
    }

    public function create($event_id)
    {
        $events = EventLomba::all();
        return view('dashboard.lomba', compact('event_id'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_lomba' => 'required|string',
                'keterangan' => 'required|string',
                'ruangan_lomba' => 'required|string',
                'kuota_lomba' => 'required|integer',
                'pelaksanaan_lomba' => 'required|date',
                'event_id' => 'required|exists:event_lomba,id',
            ]);

            Lomba::create($validatedData);

            return redirect()->route('dashboard.lomba', ['event_id' => $request->event_id])->with('success', 'Lomba berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->route('dashboard.lomba', ['event_id' => $request->event_id])->with('error', 'Terjadi kesalahan SQL: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('dashboard.lomba', ['event_id' => $request->event_id])->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        try {
            $lomba = Lomba::findOrFail($id);

            info('Lomba found: ' . json_encode($lomba));

            return response()->json(['lomba' => $lomba], 200);
        } catch (\Exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $id = $request->input('id');
            $lomba = Lomba::findOrFail($id);
            $lomba->nama_lomba = $request->input('nama_lomba') ?? $lomba->nama_lomba;
            $lomba->keterangan = $request->input('keterangan') ?? $lomba->keterangan;
            $lomba->ruangan_lomba = $request->input('ruangan_lomba') ?? $lomba->ruangan_lomba;
            $lomba->kuota_lomba = $request->input('kuota_lomba') ?? $lomba->kuota_lomba;
            $lomba->pelaksanaan_lomba = $request->input('pelaksanaan_lomba') ?? $lomba->pelaksanaan_lomba;

            $lomba->update();

            return redirect()->back()->with('status', 'Data Lomba berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Lomba: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $lomba = Lomba::find($id);

        if (!$lomba) {
            return response()->json(['error' => 'lomba not found'], 404);
        }

        return response()->json(['lomba' => $lomba], 200);
    }


    public function destroy($id)
    {
        try {
            $lomba = Lomba::findOrFail($id);
            $lomba->delete();
            info('Lomba found: ' . json_encode($lomba));

            return response()->json(['lomba' => $lomba], 200);
        } catch (\Exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
