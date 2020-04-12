<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingRepository
{
    public function createShipping(Request $request)
    {
        try {
            $envio = Shipping::create([
                'user_id' => $request->user_id,
                'street_one' => e(strtolower($request->street_one)),
                'street_two' => empty($request->street_two) ? '' : e(strtolower($request->street_two)),
                'addres' => e(strtolower($request->addres)),
                'suburb' => e(strtolower($request->suburb)),
                'town' => e(strtolower($request->town)),
                'state' => e(strtolower($request->state)),
                'country_code' => e(strtoupper($request->country)),
                'postal_code' => e(strtolower($request->postal_code)),
                'status' => 1
            ]);

            if ($envio) {
                Log::notice('La direccion de envio ' . $request->street_one . ' se creo correctamente');
                return 201;
            }

            Log::warning('La direccion de envio ' . $request->street_one . ' no se creo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al crear la direccion de envio ' . $request->street_one . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function updateShipping(Request $request, $shipping)
    {
        try {
            $envio = Shipping::where('id', $shipping->id)->update([
                'street_one' => e(strtolower($request->street_one)),
                'street_two' => empty($request->street_two) ? '' : e(strtolower($request->street_two)),
                'addres' => e(strtolower($request->addres)),
                'suburb' => e(strtolower($request->suburb)),
                'town' => e(strtolower($request->town)),
                'state' => e(strtolower($request->state)),
                'country_code' => e(strtoupper($request->country)),
                'postal_code' => e(strtolower($request->postal_code)),
                'status' => $request->status
            ]);

            if ($envio) {
                Log::notice('La direccion de envio ' . $request->street_one . ' se actualizo correctamente');
                return 200;
            }

            Log::warning('La direccion de envio ' . $request->street_one . ' no se actualizo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la direccion de envio ' . $request->street_one . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function deleteShipping($shipping)
    {
        $envio = $shipping->delete();
        
        if ($envio) {
            Log::notice('La direccion de envio ' . $shipping->street_one . ' se elimino correctamente');
            return 204;
        }

        Log::warning('La direccion de envio ' . $shipping->street_one . ' no se elimino');
        return 400;
    }
}
