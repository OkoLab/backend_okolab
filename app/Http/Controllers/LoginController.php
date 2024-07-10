<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(AuthUserRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'User authenticated successfully.',
                200
            ]);
        } else {
            return response()->json(['error' => 'Credentials do not match'], 422);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'User logged out successfully.',
            200
        ]);
    }
}
