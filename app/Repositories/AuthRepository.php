<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class AuthRepository
{
    public function autenticacion(Request $request)
    {
        $user = User::where('email', $request->email)->where('status', 1);
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response(null, 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
