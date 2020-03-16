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
            Shipping::create([
                'user_id' => $request->user_id,
                'street_one' => e(strtolower($request->street_one)),
                'street_two' => empty($request->street_two) ? '' : e(strtolower($request->street_two)),
                'addres' => e(strtolower($request->addres)),
                'suburb' => e(strtolower($request->suburb)),
                'town' => e(strtolower($request->town)),
                'state' => e(strtolower($request->state)),
                'country' => e(strtolower($request->country)),
                'postal_code' => e(strtolower($request->postal_code)),
                'status' => 1
            ]);

            Log::notice('La direccion de envio ' . $request->street_one . ' se creo correctamente');

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear la direccion de envio ' . $request->street_one . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function updateShipping(Request $request, $id)
    {
        $shipping = Shipping::find($id);
     
        if(is_null($shipping)) {
            return 422;
        }

        try {
            Shipping::where('id', $shipping->id)->update([
                'street_one' => e(strtolower($request->street_one)),
                'street_two' => empty($request->street_two) ? '' : e(strtolower($request->street_two)),
                'addres' => e(strtolower($request->addres)),
                'suburb' => e(strtolower($request->suburb)),
                'town' => e(strtolower($request->town)),
                'state' => e(strtolower($request->state)),
                'country' => e(strtolower($request->country)),
                'postal_code' => e(strtolower($request->postal_code)),
                'status' => $request->status
            ]);

            Log::notice('La direccion de envio ' . $request->street_one . ' se actualizo correctamente');

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar la direccion de envio ' . $request->street_one . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function deleteShipping($id)
    {
        $shipping = Shipping::find($id);
        
        if(is_null($shipping)) {
            return 422;
        }

        $shipping->delete();
        
        Log::notice('La direccion de envio ' . $shipping->street_one . ' se elimino correctamente');

        return 204;
    }
}
