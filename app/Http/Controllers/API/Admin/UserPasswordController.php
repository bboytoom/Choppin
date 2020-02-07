<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\User;

class UserPasswordController extends Controller
{
    public function updateUser(PasswordRequest $request, $id)
    {
        User::where('id', $id)->update([
            'password' => \Hash::make($request->get('password')) 
        ]);

        return response([
            'message' => 'Se actualizò correctamente'
        ], 200);
    }
}
