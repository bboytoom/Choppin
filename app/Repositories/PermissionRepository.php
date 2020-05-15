<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionRepository
{
    public function createPermission(Request $request)
    {
        try {
            $permi = Permission::create([
                'name' => e(strtolower($request->name)),
                'permission' => $request->permission,
                'status' => 1
            ]);

            if (!$permi) {
                Log::warning('El permiso ' . $request->name . ' no se creo');
                return 400;
            }

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear el permiso ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function updatePermission(Request $request, $permission)
    {
        try {
            $permi = Permission::where('id', $permission->id)->update([
                'name' => e(strtolower($request->name)),
                'permission' => $request->permission,
                'status' => $request->status
            ]);

            if (!$permi) {
                Log::warning('El permiso ' . $request->name . ' no se actualizo');
                return 400;
            }

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el permiso ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function deletePermission($permission)
    {
        $permi = $permission->delete();

        if (!$permi) {
            Log::warning('El permiso ' . $permission->name . ' no se elimino');
            return 400;
        }

        return 204;
    }
}
