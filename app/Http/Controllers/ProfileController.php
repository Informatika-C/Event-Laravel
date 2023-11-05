<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function edit()
    {
        $user = auth()->user();

        return view('edit-profile', compact('users'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $data = $request->all();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'npm' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ];

        $validation = ValidatorFacade::make($data, $rules);

        if ($validation->passes()) {
            $user->update($data);
            return back()->with('success', 'Profil berhasil diperbarui');
        }

        return back()->withErrors($validation)->withInput();
    }
}
