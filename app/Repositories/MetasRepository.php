<?php

namespace App\Repositories;

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

        Metas::where('id', $meta->id)->update([
            'keyword' => e(strtolower($request->keyword)),
            'description' => e(strtolower($request->description))
        ]);

        return 200;
    }
}
