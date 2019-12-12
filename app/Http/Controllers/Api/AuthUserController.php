<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthUserController extends Controller
{
    public function register(StoreRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if($user)
        {
            return response()->json(
                [
                    'message' => 'El usuario se creo correctamente'
                ]
            );
        }

        return response()->json(
            [
                'message' => 'Ocurrio un problema al agregar el usuario'
            ]
        );
    }

    public function userLogin(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                return response()->json(
                    [
                        'toke' => $user->createToken('UserClient')->accessToken
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
