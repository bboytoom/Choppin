<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class PerfilRepository
{
    public function updatePerfil(Request $request, $id)
    {
        $user = User::find($id);

        if(is_null($user)) {
            return 422;
        }

        if ($request->status == 0 || $request->type == 'administrador') {
            return 422;    
        }

        User::where('id', $user->id)->update($request->except(['password_confirmation']));
        return 200;
    }
}
