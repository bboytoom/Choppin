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
            $charact = Characteristic::create([
                'product_id' => $request->product_id,
                'name' => e(strtolower($request->name)),
                'description' => e(strtolower($request->description)),
                'status' => 1
            ]);

            if ($charact) {
                Log::notice('La caracteristica ' . $request->name . ' se creo correctamente');
                return 201;
            }

            Log::warning('La caracteristica ' . $request->name . ' no se creo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al crear la caracteristica ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function updateCharacteristic(Request $request, $characteristic)
    {
        try {
            $charact = Characteristic::where('id', $characteristic->id)->update([
                'product_id' => $request->product_id,
                'name' => e(strtolower($request->name)),
                'description' => e(strtolower($request->description)),
                'status' => $request->status
            ]);

            if ($charact) {
                Log::notice('La caracteristica ' . $request->name . ' se actualizo correctamente');
                return 200;
            }

            Log::warning('La caracteristica ' . $request->name . ' no se actualizo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la caracteristica ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function deleteCharacteristic($characteristic)
    {
        $charact = $characteristic->delete();

        if ($charact) {
            Log::notice('La caracteristica ' . $characteristic->name . ' se elimino correctamente');
            return 204;
        }

        Log::warning('La caracteristica ' . $characteristic->name . ' no se elimino');
        return 400;
    }
}
