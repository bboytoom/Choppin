<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Admin;
use Auth;

class AuthAdminController extends Controller
{
    public function logIn(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if($admin) {
            if (Hash::check($request->password, $admin->password)) {
                $token = $admin->createToken('soy administrador')->accessToken;
                return response()->json([
                    'token' => $token
                ], 200);
            } else {
                return response()->json(['error' => 'la contraseña o el usuario es incorrecto'], 422);
            }
        }

        return response()->json(['error' => 'el usuario no existe'], 422);
    }
}
