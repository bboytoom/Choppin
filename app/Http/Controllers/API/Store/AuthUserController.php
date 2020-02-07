<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class AuthUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('logIn');
    }

    public function logIn(StoreLoginRequest $request)
    {
        $user = User::where('email', $request->email)->where('status', 1);
        
        if ($user) {
            $credentials = request(['email', 'password']);
            
            if (! $token = auth()->attempt($credentials)) {
                return response(null, 401);
            }

            return $this->respondWithToken($token, $user->first());
        }

        return response(null, 204);
    }

    public function logOut()
    {
        auth()->logout();

        return response()->json(['message' => 'Salió correctamente']);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'attributes' => [
                'type' => $user->type,
                'name' => $user->name,
                'mother_surname' => $user->mother_surname,
                'father_surname' => $user->father_surname,
            ],
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
