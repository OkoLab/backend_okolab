<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function store(StoreUserRequest $request)
    // {
    //     if ($request->validated()) {
    //         User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         return response()->json(['message' => 'User created successfully.'], 201);
    //     }
    // }

    public function login(AuthUserRequest $request)
    {
        if ($request->validated()) {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'User authenticated successfully.',
                    'user' => $user,
                    'token' => $user->createToken('auth_token')->plainTextToken,
                     200]);
            } else {
                return response()->json(['message' => 'User not found.'], 404);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User logged out successfully.'], 200);
    }
}
