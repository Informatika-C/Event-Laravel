<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function search(Request $request)
    {
        $user = [];
        if ($request->has('q')) {
            $search = $request->q;
            $user = User::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($user, 200);
    }
}
