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

        User::create($request->all());
        return 201;
    }

    public function updateAdministrator(Request $request, $id)
    {
        $user = User::find($id);

        if(is_null($user)) {
            return 422;
        }

        User::where('id', $user->id)->update($request->except(['password_confirmation']));
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
