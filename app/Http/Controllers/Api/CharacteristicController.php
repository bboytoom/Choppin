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
    public function index()
    {
        return new CharacteristicCollection(Characteristic::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacteristicRequest $request)
    {
        $characteristic = Characteristic::create([
            'admin_id' => $request->get('admin_id'),
            'product_id' => $request->get('product_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'status' => $request->get('status')
        ]);

        return response()->json(
            [
                'data' => [
                    'characteristics' => [
                        'name' => $characteristic->name
                    ]
                ]
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $characteristic =  Characteristic::find($id);

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
    public function update(CharacteristicRequest $request, $id)
    {
        $characteristic =  Characteristic::find($id);
        $characteristic->name = $request->get('name');
        $characteristic->description = $request->get('description');
        $characteristic->status = $request->get('status');
        $characteristic->save();

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
        $characteristic =  Characteristic::find($id);
        $characteristic->delete();

        return response(null, 204);
    }
}
