<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'npm' => 'required|max:10',
            'phone' => 'required|max:13',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
    
        $user = User::create($validatedData);
        $token = $user->createToken("test")->plainTextToken;
    
        return response()->json([
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request) {
        if(!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
    
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken("test")->plainTextToken;
    
        return response()->json([
            'token' => $token,
            'user' => $user
        ], 201);
    }
}