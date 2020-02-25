<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\User;

class PerfilRepository
{
    public function updatePerfil(Request $request)
    {
        if ($request->status == 0 || $request->type == 'administrador') {
            return 422;    
        }

        User::where('id', $request->id)->update($request->except(['password_confirmation']));
        return 200;
    }
}
