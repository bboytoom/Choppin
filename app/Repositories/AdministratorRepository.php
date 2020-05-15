<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\User;

class AdministratorRepository
{
    public function createAdministrator(Request $request)
    {
        if ($request->type != 'staff') {
            return 422;
        }

        try {
            $admin = User::create([
                'permission_id' => $request->permission_id,
                'type' => $request->type,
                'name' => e(strtolower($request->name)),
                'mother_surname' => empty($request->mother_surname) ? '' : e(strtolower($request->mother_surname)),
                'father_surname' => e(strtolower($request->father_surname)),
                'email' => e(strtolower($request->email)),
                'password' => \Hash::make($request->password),
                'status' => 1
            ]);

            if (!$admin) {
                Log::warning('El usuario ' . $request->email . ' no se creo');
                return 400;
            }

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear el usuario ' . $request->email . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function updateAdministrator(Request $request, $administration)
    {
        try {
            $admin = User::where('id', $administration->id)->update([
                'name' => e(strtolower($request->name)),
                'mother_surname' => empty($request->mother_surname) ? '' : e(strtolower($request->mother_surname)),
                'father_surname' => e(strtolower($request->father_surname)),
                'email' => e(strtolower($request->email)),
                'password' => empty($request->password) ? $administration->password : \Hash::make($request->password),
                'status' => ($administration->type == 'administrador') ? 1 : $request->status
            ]);

            if (!$admin) {
                Log::warning('El usuario ' . $request->email . ' no se actualizo');
                return 400;
            }

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el usuario ' . $request->email . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function deleteAdministrator($administration)
    {
        $admin = $administration->delete();

        if (!$admin) {
            Log::warning('El usuario ' . $administration->email . ' no se elimino');
            return 400;
        }

        return 204;
    }
}
