<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingRepository
{
    public function createShipping(Request $request)
    {
        Shipping::create($request->all());
        return 201;
    }

    public function updateShipping(Request $request, $id)
    {
        $shipping = Shipping::find($id);
     
        if(is_null($shipping)) {
            return 422;
        }

        Shipping::where('id', $shipping->id)->update($request->all());
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
