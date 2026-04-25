<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => JWTAuth::user()
        ]);
    }

    public function me()
    {
        return response()->json(JWTAuth::parseToken()->authenticate());
    }

    public function logout()
    {
        JWTAuth::parseToken()->invalidate();
        return response()->json(['message' => 'Logout realizado']);
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => JWTAuth::parseToken()->refresh()
        ]);
    }
}
?>