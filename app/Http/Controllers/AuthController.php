<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:15',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('access_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'user' => auth()->user()
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthenticated'
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function logout()
    {
        // Revoke all tokens...
        auth()->user()->tokens()->delete();
        return response()->noContent();
    }
}
