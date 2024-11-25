<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request, $role)
    {
        $credentials = $request->only(['email', 'password']);

        $guard = $role === 'admin' ? 'admin' : 'api';

        if (!$token = Auth::guard($guard)->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard($guard)->factory()->getTTL() * 60,
        ]);
    }

    public function logout(Request $request, $role)
    {
        $guard = $role === 'admin' ? 'admin' : 'api';

        Auth::guard($guard)->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}