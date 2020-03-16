<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Characteristic;

class CharacteristicRepository
{
    public function createCharacteristic(Request $request)
    {
        try {
            Characteristic::create([
                'product_id' => $request->product_id,
                'name' => e(strtolower($request->name)),
                'description' => e(strtolower($request->description)),
                'status' => 1
            ]);

            Log::notice('La caracteristica ' . $request->name . ' se creo correctamente');

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear la caracteristica ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function updateCharacteristic(Request $request, $id)
    {
        $characteristic = Characteristic::find($id);
        
        if(is_null($characteristic)) {
            return 422;
        }

        try {
            Characteristic::where('id', $characteristic->id)->update([
                'product_id' => $request->product_id,
                'name' => e(strtolower($request->name)),
                'description' => e(strtolower($request->description)),
                'status' => $request->status
            ]);

            Log::notice('La caracteristica ' . $request->name . ' se actualizo correctamente');

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la caracteristica ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function deleteCharacteristic($id)
    {
        $characteristic = Characteristic::find($id);
        
        if(is_null($characteristic)) {
            return 422;
        }

        $characteristic->delete();

        Log::notice('La caracteristica ' . $characteristic->name . ' se elimino correctamente');
        
        return 204;
    }
}
