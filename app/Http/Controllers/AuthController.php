<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('user', $username)->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 401);
        }

        //if (md5($password) !== $user->password) {
        if(md5($password) !== $user->pass){
            return response()->json(['status' => 'error', 'message' => 'Contraseña incorrecta'], 401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->user,
            ]
        ]);
    }

    public function me()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }
    }
}
