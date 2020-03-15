<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingRepository
{
    public function createShipping(Request $request)
    {
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

        return 201;
    }

    public function updateShipping(Request $request, $id)
    {
        $shipping = Shipping::find($id);
     
        if(is_null($shipping)) {
            return 422;
        }

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

        return 200;
    }

    public function deleteShipping($id)
    {
        $shipping = Shipping::find($id);
        
        if(is_null($shipping)) {
            return 422;
        }

        $shipping->delete();
        return 204;
    }
}
