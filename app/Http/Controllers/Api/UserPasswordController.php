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
        if (config('app.key') == $request->header('APP_KEY')) {
            Admin::where('id', $id)->update([
                'password' => \Hash::make($request->get('password')) 
            ]);

            return response(null, 200);
        } else {
            abort(401);
        }
    }

    public function updateUser(PasswordRequest $request, $id)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            User::where('id', $id)->update([
                'password' => \Hash::make($request->get('password')) 
            ]);

            return response(null, 200);
        } else {
            abort(401);
        }
    }
}
