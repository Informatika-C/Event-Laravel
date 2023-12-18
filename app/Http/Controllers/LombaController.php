<?php

namespace App\Http\Controllers;

use App\Events\RegisterLomba;
use App\Models\EventLomba;
use App\Models\Kategori;
use App\Models\KategoriLomba;
use App\Models\Kelompok;
use App\Models\KelompokPeserta;
use App\Models\Lomba;
use App\Models\LombaKelompok;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class LombaController extends Controller
{
    public function index(Request $request, $event_id, EventLomba $event)
    {
        $lombas = $event->lombas;
        // $event_id = $request->input('event_id');
        $lombas = $event_id ? Lomba::where('event_id', $event_id)->get() : Lomba::all();

        // get all event
        $events = EventLomba::all();

        // get all kategori
        $kategoris = Kategori::all();

        // get kaegori from lombas
        foreach ($lombas as $lomba) {
            $lomba->kategoris = KategoriLomba::where('lomba_id', $lomba->id)->get();
            // get name kategri from kategori id
            foreach ($lomba->kategoris as $kategoris) {
                $kategoris->nama_kategori = Kategori::find($kategoris->kategori_id)->nama_kategori;
            }
        }

        return view('dashboard.lomba', compact('lombas', 'event_id', 'event', 'kategoris'));
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
                'max_anggota' => 'required|integer',
                'biaya_registrasi' => 'required|integer',
                'pelaksanaan_lomba' => 'required|date',
                'event_id' => 'required|exists:event_lomba,id',
            ]);

            $lomba = Lomba::create($validatedData);

            // get kategori from request as array
            $kategori_ids = $request->input('kategori');

            // for each kategori, create a new KategoriLomba
            if ($kategori_ids != null) {
                foreach ($kategori_ids as $kategori_id) {
                    KategoriLomba::create([
                        'kategori_id' => $kategori_id,
                        'lomba_id' => $lomba->id,
                    ]);
                }
            }

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
            $lomba->max_anggota = $request->input('max_anggota') ?? $lomba->max_anggota;
            $lomba->biaya_registrasi = $request->input('biaya_registrasi') ?? $lomba->biaya_registrasi;
            $lomba->pelaksanaan_lomba = $request->input('pelaksanaan_lomba') ?? $lomba->pelaksanaan_lomba;

            $lomba->update();

            // get kategori from request as array
            $kategori_ids = $request->input('kategori');

            if ($kategori_ids == -1) {
                KategoriLomba::where('lomba_id', $id)->delete();
            }

            // for each kategori, create a new KategoriLomba
            if (is_array($kategori_ids)) {
                if ($kategori_ids != null) {
                    KategoriLomba::where('lomba_id', $id)->delete();
                    foreach ($kategori_ids as $kategori_id) {
                        KategoriLomba::create([
                            'kategori_id' => $kategori_id,
                            'lomba_id' => $id,
                        ]);
                    }
                }
            }

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

            // check if image exists
            if (Storage::exists('public/lomba/poster/' . $id)) {
                Storage::deleteDirectory('public/lomba/poster/' . $id);
            }

            return response()->json(['lomba' => $lomba], 200);
        } catch (\Exception) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function uploadImage(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'poster' => 'image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $id = $request->input('id');

        $poster = $request->file('poster');
        if ($poster != null) $posterExt = $poster->getClientOriginalExtension();

        // delete old image
        if ($poster != null) Storage::deleteDirectory('public/lomba/poster/' . $id);

        if ($poster != null) {
            Storage::putFileAs('public/lomba/poster/' . $id, $poster, 'poster_' . $id . '.' . $posterExt);
        }

        // update image path in database
        $lomba = Lomba::find($id);
        if ($poster != null) $lomba->poster = 'poster_' . $id . '.' . $posterExt;

        $lomba->update();

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'lomba_id' => 'required|exists:lomba,id',
                'kelompok_id' => 'required|exists:kelompok,id',
            ]);

            $lomba = Lomba::find($validatedData['lomba_id']);
            $kelompok = Kelompok::find($validatedData['kelompok_id']);

            // check if kelompok already registered
            $isRegistered = LombaKelompok::where('lomba_id', $lomba->id)->where('kelompok_id', $kelompok->id)->first();
            if ($isRegistered != null) {
                throw ValidationException::withMessages([
                    'kelompok_id' => 'Kelompok sudah terdaftar pada lomba ini.',
                ]);
            }

            // create new LombaKelompok
            $lombaKelompok = LombaKelompok::create([
                'lomba_id' => $lomba->id,
                'kelompok_id' => $kelompok->id,
            ]);

            // dispatch event
            RegisterLomba::dispatch($lomba);

            return response()->json([
                'message' => 'Pendaftaran Berhasil.',
                'lombaKelompok' => $lombaKelompok,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function unregister()
    {
        $validatedData = request()->validate([
            'lomba_id' => 'required|exists:lomba,id',
        ]);

        // get kelompok by user id and lomba id
        $kelompoks = KelompokPeserta::where('peserta_id', auth()->user()->id)->get();
        $lomba = Lomba::find($validatedData['lomba_id']);

        $lombaKelompok = LombaKelompok::where('lomba_id', $lomba->id)->whereIn('kelompok_id', $kelompoks->pluck('kelompok_id'))->first();

        // get kelompok by kelompok id
        $kelompok = Kelompok::find($lombaKelompok->kelompok_id);

        // if kelompok is solo, delete only lomba_kelompok
        if ($kelompok->nama_kelompok == 'solo_' . auth()->user()->id) {

            $lombaKelompok->delete();

            // dispatch event
            RegisterLomba::dispatch($lomba);

            return back()->with('success', 'Berhasil keluar lomba' . $lomba->nama_lomba);
        }

        // delete kelompok peserta
        KelompokPeserta::where('kelompok_id', $kelompok->id)->delete();

        // delete kelompok
        $kelompok->delete();

        // dispatch event
        RegisterLomba::dispatch($lomba);

        return back()->with('success', 'Berhasil keluar lomba' . $lomba->nama_lomba);
    }

    public function registerSolo(Request $request)
    {
        // validate
        $validatedData = $request->validate([
            'password' => 'required|string',
            'lomba_id' => 'required|exists:lomba,id',
        ]);

        // check password with user password
        $hasher = app('hash');
        $user = auth()->user();
        if (!$hasher->check($validatedData['password'], $user->password)) {
            return back()->with('error', 'Password salah.');
        }

        // get user id
        $user_id = auth()->user()->id;

        // get name
        $lomba = Lomba::find($request->input('lomba_id'));

        // check peserta registered
        $lombaKelompoks = LombaKelompok::where('lomba_id', $lomba->id)->get();
        $pesertaRegistered = 0;

        foreach ($lombaKelompoks as $lombaKelompok) {
            $kelompokPesertas = KelompokPeserta::where('kelompok_id', $lombaKelompok->kelompok_id)->get();
            $pesertaRegistered += count($kelompokPesertas);
        }

        if ($pesertaRegistered + 1 > $lomba->kuota_lomba) {
            return back()->with('error', 'Kuota lomba sudah penuh.');
        }

        // check 'solo_'.$user_id, if exist return already exist
        $kelompok = Kelompok::where('nama_kelompok', 'solo_' . $user_id)->first();
        if (!$kelompok) {
            // create new kelompok
            $kelompok = Kelompok::create([
                'nama_kelompok' => 'solo_' . $user_id,
                'ketua_id' => $user_id,
            ]);

            // insert user to kelompok_peserta
            KelompokPeserta::create([
                'kelompok_id' => $kelompok->id,
                'peserta_id' => $user_id,
            ]);
        }

        // set request kelompok_id to kelompok->id
        $request->merge(['kelompok_id' => $kelompok->id]);

        $this->register($request);

        return back()->with('success', 'Berhasil mendaftar ' . $lomba->nama_lomba);
    }

    public function registerGrup(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_grup' => 'required|string|unique:kelompok,nama_kelompok',
                'password' => 'required|string',
                'lomba_id' => 'required|exists:lomba,id',
                'anggota' => 'required|array',
            ]);
            $anggota = $validatedData['anggota'];

            // check if anggota same each other
            $anggota_unique = array_unique($anggota);
            if (count($anggota) != count($anggota_unique)) {
                throw ValidationException::withMessages([
                    'anggota' => 'Anggota not unique.',
                ]);
            }
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        }

        // check password with user password
        $hasher = app('hash');
        $user = auth()->user();
        if (!$hasher->check($validatedData['password'], $user->password)) {
            return back()->with('error', 'Password salah.');
        }

        // get lomba
        $lomba = Lomba::find($request->input('lomba_id'));

        // check peserta registered
        $lombaKelompoks = LombaKelompok::where('lomba_id', $lomba->id)->get();
        $pesertaRegistered = 0;

        foreach ($lombaKelompoks as $lombaKelompok) {
            $kelompokPesertas = KelompokPeserta::where('kelompok_id', $lombaKelompok->kelompok_id)->get();
            $pesertaRegistered += count($kelompokPesertas);
        }

        if ($pesertaRegistered + count($anggota) > $lomba->kuota_lomba) {
            return back()->with('error', 'Kuota lomba sudah penuh.');
        }

        // create new kelompok and ketua as first anggota
        $kelompok = Kelompok::create([
            'nama_kelompok' => $validatedData['nama_grup'],
            'ketua_id' => $anggota[0]
        ]);

        // insert anggota to kelompok_peserta
        foreach ($anggota as $peserta_id) {
            KelompokPeserta::create([
                'kelompok_id' => $kelompok->id,
                'peserta_id' => $peserta_id,
            ]);
        }

        // set request kelompok_id to kelompok->id
        $request->merge(['kelompok_id' => $kelompok->id]);

        $this->register($request);

        return back()->with('success', 'Berhasil mendaftar ' . $lomba->nama_lomba);
    }
}
