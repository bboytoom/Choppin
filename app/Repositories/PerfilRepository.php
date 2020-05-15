<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\User;

class PerfilRepository
{
    public function updatePerfil(Request $request, $perfil)
    {
        try {
            $per = User::where('id', $perfil->id)->update([
                'name' => e(strtolower($request->name)),
                'mother_surname' => empty($request->mother_surname) ? '' : e(strtolower($request->mother_surname)),
                'father_surname' => e(strtolower($request->father_surname)),
                'email' => e(strtolower($request->email)),
                'password' => empty($request->password) ? $perfil->password : \Hash::make($request->password),
                'status' => 1
            ]);

            if (!$per) {
                Log::warning('El perfil del usuario ' . $request->email . ' no se actualizo');
                return 400;
            }

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el perfil del usuario' . $request->email . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }
}
