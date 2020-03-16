<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Metas;

class MetasRepository
{
    public function updateMetas(Request $request, $id)
    {
        $meta = Metas::find($id);

        if(is_null($meta)) {
            return 422;
        }

        try {
            Metas::where('id', $meta->id)->update([
                'keyword' => e(strtolower($request->keyword)),
                'description' => e(strtolower($request->description))
            ]);

            Log::notice('El metadato se actualizo correctamente');

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el metadato, ya que muestra la siguiente Exception ' . $e);
        }
    }
}
