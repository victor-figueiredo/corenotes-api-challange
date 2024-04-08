<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse {
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $response = [
          'error' => ''  ,
          'token' => $user->createToken('Register_token')->plainTextToken
        ];
        return response()->json($response);
    }

    public function login(LoginRequest $request): JsonResponse {
        $data = $request->only(['email', 'password']);
        if (Auth::attempt($data)) {
            $user = Auth::user();
            $response = [
                'error' => '',
                'token' => $user->createToken('Login_token')->plainTextToken
            ];
            return response()->json($response);
        }
        return response()->json(['error' => 'Usuário ou Senha Inválidos']);
    }

    public function logout(Request $request): JsonResponse {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['error' => '']);
    }

    public function user(): JsonResponse {
        $response = [
            'error' => '',
            'user' => Auth::user(),
        ];
        return response()->json($response);
    }

    public function unauthenticated(): JsonResponse {
        return response()->json(['error' => 'Usuário não está logado.']);
    }
}