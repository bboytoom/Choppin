<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class AuthRepository
{
    public function autenticacion(Request $request)
    {
        $remember = 0;

        if (! $token = Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {         
            return false;
        }

        if ($request->remember) {
            User::where('email', $request->email)->update(['remember' => 1]);
            $remember = 43200;
        } else {
            $remember = 60;
        }

        return $this->respondWithToken($token, $remember);
    }

    public function refresh()
    {
        $remember = 0;
        $user = auth()->user();

        if ($user->remember) {
            $remember = 43200;
        } else {
            $remember = 60;
        }

        return $this->respondWithToken(auth()->refresh(), $remember);
    }

    protected function respondWithToken($token, $remember)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() *  $remember
        ]);
    }
}
