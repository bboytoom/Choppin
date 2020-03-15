<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class CustomerRepository
{
    public function updateCustomer(Request $request, $id)
    {
        $data = $request->except(['password_confirmation']);
        $user = User::find($id);

        if(is_null($user)) {
            return 422;
        }

        User::where('id', $user->id)->update([
            'name' => e(strtolower($data['name'])),
            'mother_surname' => empty($data['mother_surname']) ? '' : e(strtolower($data['mother_surname'])),
            'father_surname' => e(strtolower($data['father_surname'])),
            'email' => e(strtolower($data['email'])),
            'password' => empty($data['password']) ? $user->password : \Hash::make($data['password']),
            'status' => $data['status']
        ]);

        return 200;
    }

    public function deleteCustomer($id)
    {
        $user = User::find($id);

        if(is_null($user)) {
            return 422;
        }

        $user->delete();
        return 204;
    }
}
