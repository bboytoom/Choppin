<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class AdministratorRepository
{
    public function createAdministrator(Request $request)
    {
        if ($request->type == 'administrador') {
            return 422;
        }

        User::create([
            'type' => $request->type,
            'name' => e(strtolower($request->name)),
            'mother_surname' => empty($request->mother_surname) ? '' : e(strtolower($request->mother_surname)),
            'father_surname' => e(strtolower($request->father_surname)),
            'email' => e(strtolower($request->email)),
            'password' => \Hash::make($request->password),
            'status' => 1
        ]);

        return 201;
    }

    public function updateAdministrator(Request $request, $id)
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
            'status' => ($user->type == 'administrador') ? 1 : $data['status']
        ]);
      
        return 200;
    }

    public function deleteAdministrator($id)
    {
        $user = User::findOrFail($id);
        
        if($user->type == 'administrador') {
            return 422;
        }
        
        $user->delete();
        return 204;
    }
}
