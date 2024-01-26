<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Validation\ValidationException;
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
        $user = $request->user();

        try {
            $validatedData = $request->validate([
                'name' => 'max:55',
                'npm' => 'max:10|unique:users,npm,' . $user->id,
                'phone' => 'max:13|unique:users,phone,' . $user->id,
                'email' => 'email|unique:users,email,' . $user->id,
                'password' => 'confirmed'
            ]);

            $user->update([
                'name' => $validatedData['name'] ?? $user->name,
                'npm' => $validatedData['npm'] ?? $user->npm,
                'phone' => $validatedData['phone'] ?? $user->phone,
                'email' => $validatedData['email'] ?? $user->email,
                'password' => $validatedData['password'] ?? $user->password
            ]);

            return back()->with('success', 'Profile updated successfully!');
        } catch (ValidationException $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        } catch (Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
