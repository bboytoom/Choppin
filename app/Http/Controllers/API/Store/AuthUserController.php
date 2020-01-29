<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Auth;

class AuthUserController extends Controller
{
    public function logIn(Request $request)
    {
        if (config('app.key') == $request->header('x-api-key')){
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('soy usuarios')->accessToken;
                    return response()->json(['token' => $token], 200);
                } else {
                    return response()->json(['error' => 'la contraseña o el usuario es incorrecto'], 422);
                }
            }

            return response()->json(['error' => 'el usuario no existe'], 422);
        } else {
            abort(401);
        }
    }
}
