<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember_me = $request->get('remember_me', false);

        if (Auth::guard('admin')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect('/');
        } elseif (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'npm' => ['required', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'npm' => $credentials['npm'],
            'phone' => $credentials['phone'],
            'password' => $credentials['password'],
        ]);

        return redirect('/login');
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::check()) {
            Auth::logout();
        }

        return redirect('/login');
    }
}
