<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ContestantController extends Controller
{
    public function index()
    {
        try {
            $limit = 10;
            $sortType = request('sort');
            $users = User::take($limit)->get();

            return view('dashboard.contestant', compact('users', 'limit'));
        } catch (\Exception $e) {
            if ($e instanceof QueryException) {
                return redirect('/dashboard/contestant')->with('error', 'Terjadi kesalahan SQL: ' . $e->getMessage());
            }
            return redirect('/dashboard/contestant')->with('error', 'Data User kosong.');
        }
    }

    public function showAllContestants()
    {
        $users = User::all();
        $sortType = request('sort');

        $users = User::query()
            ->when($sortType === 'alphabet', function ($query) {
                return $query->orderBy('name');
            })
            ->when($sortType === 'latest', function ($query) {
                return $query->latest();
            })
            ->when($sortType === 'id', function ($query) {
                return $query->orderBy('id');
            })
            ->get();

        return view('dashboard.contestant', compact('users', 'sortType'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        $user = [];
        if($request->has('q')) {
            $search = $request->q;
            $user = User::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($user);
    }
}