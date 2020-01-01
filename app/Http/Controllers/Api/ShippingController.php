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
    public function index($id)
    {
        return new ShippingCollection(Shipping::where('user_id', $id)->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingRequest $request)
    {
        Shipping::create([
            'user_id' => $request->get('user_id'),
            'street_one' => $request->get('street_one'),
            'street_two' => $request->get('street_two'),
            'addres' => $request->get('addres'),
            'suburb' => $request->get('suburb'),
            'town' => $request->get('town'),
            'state' => $request->get('state'),
            'country' => $request->get('country'),
            'postal_code' => $request->get('postal_code'),
            'status' => $request->get('status')
        ]);

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipping =  Shipping::find($id);

        if ($shipping == null) {
            return response(null, 404);
        }

        ShippingResource::withoutWrapping();
        return new ShippingResource($shipping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingRequest $request, $id)
    {
        $shipping = Shipping::find($id);

        if ($shipping == null) {
            return response(null, 404);
        }

        $shipping->street_one = $request->get('street_one');
        $shipping->street_two = $request->get('street_two');
        $shipping->addres = $request->get('addres');
        $shipping->suburb = $request->get('suburb');
        $shipping->town = $request->get('town');
        $shipping->state = $request->get('state');
        $shipping->country = $request->get('country');
        $shipping->postal_code = $request->get('postal_code');
        $shipping->status = $request->get('status');
        $shipping->save();

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping =  Shipping::find($id);

        if ($shipping == null) {
            return response(null, 404);
        }
        
        $shipping->delete();

        return response(null, 204);
    }
}
