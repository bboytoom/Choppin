<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Http\Resources\Shipping\ShippingResource;
use App\Http\Resources\Shipping\ShippingCollection;
use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            $shippings = Shipping::whereHas('user', function ($shippingsEstatus) {
                $shippingsEstatus->where('status', 1); 
            })->where('user_id', $id)->paginate(10);

            return new ShippingCollection($shippings);
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            Shipping::create($request->all());
            return response(null, 201);
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Shipping $shipping)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            ShippingResource::withoutWrapping();
            return new ShippingResource($shipping);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, Shipping $shipping)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            $shipping->update($request->all());
            return response(null, 200);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Shipping $shipping)
    {   
        if (config('app.key') == $request->header('APP_KEY')) {
            $shipping->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
