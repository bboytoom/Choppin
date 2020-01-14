<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CharacteristicRequest;
use App\Http\Resources\Characteristic\CharacteristicResource;
use App\Http\Resources\Characteristic\CharacteristicCollection;
use Illuminate\Http\Request;
use App\Models\Characteristic;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $characteristics = Characteristic::whereHas('product', function ($characteristicsEstatus) {
                $characteristicsEstatus->where('status', 1); 
            })->where('product_id', $id)->paginate(10);

            return new CharacteristicCollection($characteristics);
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
    public function store(CharacteristicRequest $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            Characteristic::create($request->all());
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
    public function show(Request $request, Characteristic $characteristic)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            CharacteristicResource::withoutWrapping();
            return new CharacteristicResource($characteristic);
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
    public function update(CharacteristicRequest $request, Characteristic $characteristic)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $characteristic->update($request->all());
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
    public function destroy(Request $request, Characteristic $characteristic)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $characteristic->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
