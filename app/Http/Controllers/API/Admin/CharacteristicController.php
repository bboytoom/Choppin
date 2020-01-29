<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CharacteristicRequest;
use App\Http\Resources\Characteristic\CharacteristicResource;
use App\Http\Resources\Characteristic\CharacteristicCollection;
use Illuminate\Http\Request;
use App\Models\Characteristic;

class CharacteristicController extends Controller
{
    public function __construct()
    {
        $this->middleware("authheader");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $characteristics = Characteristic::whereHas('product', function ($characteristicsEstatus) {
            $characteristicsEstatus->where('status', 1); 
        })->where('product_id', $id)->paginate(10);

        return new CharacteristicCollection($characteristics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacteristicRequest $request)
    {
        Characteristic::create($request->all());
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Characteristic $characteristic)
    {
        CharacteristicResource::withoutWrapping();
        return new CharacteristicResource($characteristic);
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
        $characteristic->update($request->all());
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Characteristic $characteristic)
    {
        $characteristic->delete();
        return response(null, 204);
    }
}
