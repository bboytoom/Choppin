<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Characteristic;

class CharacteristicRepository
{
    public function createCharacteristic(Request $request)
    {
        Characteristic::create([
            'product_id' => $request->product_id,
            'name' => e(strtolower($request->name)),
            'description' => e(strtolower($request->description)),
            'status' => 1
        ]);

        return 201;
    }

    public function updateCharacteristic(Request $request, $id)
    {
        $characteristic = Characteristic::find($id);
        
        if(is_null($characteristic)) {
            return 422;
        }

        Characteristic::where('id', $characteristic->id)->update([
            'product_id' => $request->product_id,
            'name' => e(strtolower($request->name)),
            'description' => e(strtolower($request->description)),
            'status' => $request->status
        ]);

        return 200;
    }

    public function deleteCharacteristic($id)
    {
        $characteristic = Characteristic::find($id);
        
        if(is_null($characteristic)) {
            return 422;
        }

        $characteristic->delete();
        return 204;
    }
}
