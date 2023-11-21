<?php

namespace App\Http\Controllers;

use App\Models\Kelompok;
use App\Models\KelompokPeserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class KelompokController extends Controller
{
    public function index()
    {
        // get all kelompok
        $kelompoks = Kelompok::all();
        
        return $kelompoks;
    }

    public function store(Request $request)
    {
        if($request->input('solo') == true){
            // validate request
            $user_id = auth()->user()->id;

            // check 'solo_'.$user_id, if exist return already exist
            $kelompok = Kelompok::where('nama_kelompok', 'solo_'.$user_id)->first();
            if($kelompok){
                return $kelompok;
            }

            // create new kelompok
            $kelompok = Kelompok::create([
                'nama_kelompok' => 'solo_'.$user_id,
                'ketua_id' => $user_id,
            ]);

            // insert user to kelompok_peserta
            KelompokPeserta::create([
                'kelompok_id' => $kelompok->id,
                'peserta_id' => $user_id,
            ]);

            return $kelompok;
        } 
        else
        {
            try {
                // validate request
                $validatedData = $request->validate([
                    'nama_kelompok' => 'required|string|unique:kelompok,nama_kelompok',
                    'ketua_id' => 'required|exists:users,id',
                    'peserta_ids' => 'required|array|exists:users,id|distinct',
                ]);

                 // create new kelompok
                $kelompok = Kelompok::create([
                    'nama_kelompok' => $validatedData['nama_kelompok'],
                    'ketua_id' => $validatedData['ketua_id'],
                ]);

                // attach anggota to kelompok
                $kelompok->peserta()->attach($validatedData['peserta_ids']);
                
                return $kelompok->load('peserta');

            } catch (ValidationException $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 422);
            }
        }
    }
}
