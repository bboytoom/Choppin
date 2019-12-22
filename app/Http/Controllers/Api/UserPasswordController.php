<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\Admin;
use App\User;

class UserPasswordController extends Controller
{
    public function updateAdmin(PasswordRequest $request, $id)
    {
        $admin =  Admin::find($id);

        if ($admin == null) {
            return response(null, 404);
        }

        $admin->password = \Hash::make($request->get('password'));
        $admin->save();

        return response(null, 200);
    }

    public function updateUser(PasswordRequest $request, $id)
    {
        $user =  User::find($id);

        if ($user == null) {
            return response(null, 404);
        }

        $user->password = \Hash::make($request->get('password'));
        $user->save();

        return response(null, 200);
    }
}
