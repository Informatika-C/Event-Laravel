<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
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
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], $e->status);
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
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

    public function logout(Request $request, User $user)
    {
        $token_id = $request->user()->currentAccessToken()->id;

        $user->tokens()->where('id', $token_id)->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function user(Request $request)
    {
        return $request->user();
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

            return response()->json([
                'message' => 'User updated',
                'user' => $user
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], $e->status);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updatePhoto(Request $request)
    {
        $user = $request->user();

        try {
            $validatedData = $request->validate([
                'photo_profile' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            // Delete old photo profile if exists
            if ($user->photo_profile) {
                $photo_profile_path = public_path($user->photo_profile);

                if (file_exists($photo_profile_path)) {
                    $succsess = unlink($photo_profile_path);
                    if (!$succsess) throw new Exception('Failed to delete old photo profile');
                }
            }

            $photo_profile = $validatedData['photo_profile'];

            $photo_profile_name = time() . '.' . $photo_profile->extension();

            $photo_profile->move(public_path('photo-profile'), $photo_profile_name);

            $user->update([
                'photo_profile' => 'photo-profile/' . $photo_profile_name
            ]);

            return response()->json([
                'message' => 'Photo profile updated',
                'photo_profile' => $user->photo_profile
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], $e->status);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
