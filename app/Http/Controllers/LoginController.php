<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', Password::min(8)],
        ]);
        

        $user = User::where('email', $validatedData['email'])->first();
        if (! $user) {
            return response()->json([
                'status' => 404,
                'message' => 'Invalid credentials',
            ]);
        }

        if (! Hash::check($validatedData['password'], $user->password)) {
            return response()->json([
                'status' => 404,
                'message' => 'Invalid credentials',
            ]);
        }

        return new UserResource($user);
    }
}
