<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\LombaKelompok;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function show(int $id)
    {
        $lomba = \App\Models\Lomba::with('kategori')->find($id);

        if (!$lomba) {
            return response()->json([
                'message' => 'Lomba tidak ditemukan'
            ], 404);
        }

        $lomba->deskripsi = $lomba->keterangan;


        // check if lomba is for 1 person or not
        if ($lomba->max_anggota == 1) {
            $lomba->anggota_terdaftar = LombaKelompok::where('lomba_id', $lomba->id)->count();
        }

        $lomba->anggota_terdaftar = LombaKelompok::where('lomba_id', $lomba->id)->count() * $lomba->max_anggota;

        return response()->json($lomba);
    }
}
