<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lomba;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        
        return compact('kategoris');
    }

    public function store(Request $request)
    {
        $nama_kategori = $request->input('nama_kategori');

        $kategori = Kategori::create([
            'nama_kategori' => $nama_kategori,
        ]);

        return compact('kategori');
    }

    public function lomba(Request $request, $id)
    {
        $lomba = Lomba::find($id);
        $kategoris = $lomba->kategori;

        return $kategoris;
    }
}
