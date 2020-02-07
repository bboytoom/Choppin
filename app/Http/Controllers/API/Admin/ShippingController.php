<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Http\Resources\Shipping\ShippingResource;
use App\Http\Resources\Shipping\ShippingCollection;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function index($id)
    {
        $shippings = Shipping::whereHas('user', function ($shippingsEstatus) {
            $shippingsEstatus->where('status', 1); 
        })->where('user_id', $id)->paginate(10);

        return new ShippingCollection($shippings);
    }

    public function store(ShippingRequest $request)
    {
        Shipping::create($request->all());
        
        return response([
            'message' => 'Se agrego correctamente'
        ], 201);
    }

    public function show(Shipping $shipping)
    {
        ShippingResource::withoutWrapping();
        return new ShippingResource($shipping);
    }

    public function update(ShippingRequest $request, Shipping $shipping)
    {
        $shipping->update($request->all());
        
        return response([
            'message' => 'Se actualizò correctamente'
        ], 200);
    }

    public function destroy(Shipping $shipping)
    {   
        $shipping->delete();
        return response(null, 204);
    }
}
