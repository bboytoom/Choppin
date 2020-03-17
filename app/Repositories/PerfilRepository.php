<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\User;

class PerfilRepository
{
    public function updatePerfil(Request $request, $id)
    {
        $data = $request->except(['password_confirmation']);
        $user = User::find($id);

        if(is_null($user)) {
            return 422;
        }

        try {
            User::where('id', $user->id)->update([
                'name' => e(strtolower($data['name'])),
                'mother_surname' => empty($data['mother_surname']) ? '' : e(strtolower($data['mother_surname'])),
                'father_surname' => e(strtolower($data['father_surname'])),
                'email' => e(strtolower($data['email'])),
                'password' => empty($data['password']) ? $user->password : \Hash::make($data['password']),
                'status' => 1
            ]);

            Log::notice('El perfil del usuario ' . $data['email'] . ' se actualizo correctamente');

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el perfil del usuario' .$data['email'] . ', ya que muestra la siguiente Exception ' . $e);
        }
    }
}
