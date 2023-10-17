<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');   
    }

    public function postLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember_me = $request->get('remember_me', false);

        if (Auth::guard('admin')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
          'email' => 'The provided credentials do not match our records.',  
        ])->onlyInput('email');
    }

    public function register(){
        return view('auth.register');   
    }

    public function postRegister(Request $request){
        $credentials = $request->validate([
            'name' => ['required', 'string'],  
            'email' => ['required', 'email', 'unique:users'],
            'npm' => ['required', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        if (!$credentials){
            return back()->withErrors([   
                'error' => 'error',  
            ]);
        }

        User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],  
            'npm' => $credentials['npm'],          
            'phone' => $credentials['phone'],
            'password' => $credentials['password'],
        ])->save();

        return redirect()->intended('home');
    }

    public function logout(){
        Auth::logout();   
        return redirect('/');
    }
}
