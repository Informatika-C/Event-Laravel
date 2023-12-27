<?php

namespace App\Http\Controllers\ApiControllers;

use App\Events\RegisterLomba;
use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\KelompokPeserta;
use App\Models\Lomba;
use App\Models\LombaKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LombaController extends Controller
{
    public function show(int $id)
    {
        $lomba = \App\Models\Lomba::with('kategori')->find($id);

        if (!$lomba) {
            return response()->json([
                'message' => 'Lomba not found'
            ], 404);
        }

        $lomba->deskripsi = $lomba->keterangan;

        // check if lomba is for 1 person or not
        if ($lomba->max_anggota == 1) {
            $lomba->anggota_terdaftar = LombaKelompok::where('lomba_id', $lomba->id)->count();
        }

        $lomba->anggota_terdaftar = LombaKelompok::where('lomba_id', $lomba->id)->count() * $lomba->max_anggota;

        $user = auth()->user();

        if ($user != null) {
            // check if user already registered
            $kelompok = KelompokPeserta::where('peserta_id', $user->id)->get();

            if ($kelompok->count() > 0) {
                $lombaKelompok = LombaKelompok::where('lomba_id', $lomba->id)->whereIn('kelompok_id', $kelompok->pluck('kelompok_id'))->first();

                if ($lombaKelompok != null) {
                    $lomba->sudah_terdaftar = true;
                } else {
                    $lomba->sudah_terdaftar = false;
                }
            } else {
                $lomba->sudah_terdaftar = false;
            }
        }

        return response()->json($lomba);
    }

    private function register(Request $request)
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
                    'kelompok_id' => 'Kelompok already registered',
                ]);
            }

            // create new LombaKelompok
            LombaKelompok::create([
                'lomba_id' => $lomba->id,
                'kelompok_id' => $kelompok->id,
            ]);

            // dispatch event
            RegisterLomba::dispatch($lomba);

            return;
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->status);
        }
    }

    public function unregister()
    {
        try {
            $validatedData = request()->validate([
                'lomba_id' => 'required|exists:lomba,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->status);
        }

        // get kelompok by user id and lomba id
        $kelompoks = KelompokPeserta::where('peserta_id', auth()->user()->id)->get();
        $lomba = Lomba::find($validatedData['lomba_id']);

        $lombaKelompok = LombaKelompok::where('lomba_id', $lomba->id)->whereIn('kelompok_id', $kelompoks->pluck('kelompok_id'))->first();

        // get kelompok by kelompok id
        $kelompok = Kelompok::find($lombaKelompok->kelompok_id);

        // delete lomba kelompok
        $lombaKelompok->delete();

        // delete kelompok peserta
        KelompokPeserta::where('kelompok_id', $kelompok->id)->delete();

        // delete kelompok
        $kelompok->delete();

        // dispatch event
        RegisterLomba::dispatch($lomba);

        return response()->json([
            'message' => 'Successfully unregister from ' . $lomba->nama_lomba,
        ], 200);
    }

    public function registerSolo(Request $request)
    {
        // validate
        try {
            $validatedData = $request->validate([
                'password' => 'required|string',
                'lomba_id' => 'required|exists:lomba,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->status);
        }

        // check password with user password
        $hasher = app('hash');
        $user = auth()->user();
        if (!$hasher->check($validatedData['password'], $user->password)) {
            return response()->json([
                'message' => 'Wrong password',
            ], 422);
        }

        DB::beginTransaction();

        try {
            // get user id
            $user_id = auth()->user()->id;

            // get name
            $lomba = Lomba::find($request->input('lomba_id'));

            // check peserta registered
            $pesertaRegistered = Lomba::getPesertaRegistered($lomba->id);

            if ($pesertaRegistered + 1 > $lomba->kuota_lomba) {
                return response()->json([
                    'message' => 'Lomba is full',
                ], 422);
            }

            $kelompok = Kelompok::create([
                'nama_kelompok' => 'solo_' . (string) Str::orderedUuid(),
                'ketua_id' => $user_id,
                'is_solo' => true,
            ]);

            // insert user to kelompok_peserta
            KelompokPeserta::create([
                'kelompok_id' => $kelompok->id,
                'peserta_id' => $user_id,
            ]);

            // set request kelompok_id to kelompok->id
            $request->merge(['kelompok_id' => $kelompok->id]);

            $this->register($request);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        DB::commit();

        return response()->json([
            'message' => 'Successfully register to ' . $lomba->nama_lomba,
        ], 200);
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
                return response()->json([
                    'message' => 'Anggota not unique',
                ], 422);
            }

            // check if anggota more than max_anggota
            $lomba = Lomba::find($validatedData['lomba_id']);
            if (count($anggota) > $lomba->max_anggota) {
                return response()->json([
                    'message' => 'Anggota more than max anggota',
                ], 422);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->status);
        }

        // check password with user password
        $hasher = app('hash');
        $user = auth()->user();
        if (!$hasher->check($validatedData['password'], $user->password)) {
            return response()->json([
                'message' => 'Wrong password'
            ], 422);
        }

        // check if user is in anggota
        // if (!in_array($user->id, $anggota)) {
        //     return response()->json([
        //         'message' => 'User not in anggota'
        //     ], 422);
        // }

        DB::beginTransaction();
        try {
            // check peserta registered
            $pesertaRegistered = Lomba::getPesertaRegistered($lomba->id);

            if ($pesertaRegistered + count($anggota) > $lomba->kuota_lomba) {
                return response()->json([
                    'message' => 'Lomba is full',
                ], 422);
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
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

        DB::commit();

        return response()->json([
            'message' => 'Successfully register to ' . $lomba->nama_lomba,
        ], 200);
    }

    public function userListLomba()
    {
        $user = auth()->user();
        $kelompok = KelompokPeserta::where('peserta_id', $user->id)->get();
        $lomba = LombaKelompok::whereIn('kelompok_id', $kelompok->pluck('kelompok_id'))->get();
        $lomba_id = $lomba->pluck('lomba_id');
        $lomba = Lomba::whereIn('id', $lomba_id)->with('kategori')->get();

        // use Lomba::getPesertaRegistered($lomba->id) to get peserta registered
        // and chage keterangan to deskripsi
        foreach ($lomba as $l) {
            $l->anggota_terdaftar = Lomba::getPesertaRegistered($l->id);
            $l->deskripsi = $l->keterangan;
        }

        return response()->json($lomba);
    }
}
