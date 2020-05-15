<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Metas;

class MetasRepository
{
    public function updateMetas(Request $request, $metum)
    {
        try {
            $metaEdit = Metas::where('id', $metum->id)->update([
                'keyword' => e(strtolower($request->keyword)),
                'description' => e(strtolower($request->description))
            ]);

            if (!$metaEdit) {
                Log::warning('El metadato se actualizo correctamente');
                return 400;
            }

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el metadato, ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }
}
