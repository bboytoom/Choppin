<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class AuthAdminController extends Controller
{
    public function userLogin(LoginRequest $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        
        if($admin)
        {
            if(Hash::check($request->password, $admin->password))
            {
                return response()->json(
                    [
                        'toke' => $admin->createToken('Administrator')->accessToken
                    ], 
                    200
                );
            }
            else
            {
                return response()->json(
                    [
                        'error' => 'La contraseña o el correo son incorrectos'
                    ], 
                    422
                );
            }
        }
        
        return response()->json(
            [
                'error' => 'El usuario no existe'
            ]
        );
    }
}
