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
    public function index($id)
    {
        $characteristics = Characteristic::whereHas('product', function ($characteristicsEstatus) {
            $characteristicsEstatus->where('status', 1); 
        })->where('product_id', $id)->paginate(10);

        return new CharacteristicCollection($characteristics);
    }

    public function store(CharacteristicRequest $request)
    {
        Characteristic::create($request->all());
    
        return response([
            'message' => 'Se agrego correctamente'
        ], 201);
    }

    public function show(Characteristic $characteristic)
    {
        CharacteristicResource::withoutWrapping();
        return new CharacteristicResource($characteristic);
    }

    public function update(CharacteristicRequest $request, Characteristic $characteristic)
    {
        $characteristic->update($request->all());
        
        return response([
            'message' => 'Se actualizò correctamente'
        ], 200);
    }

    public function destroy(Characteristic $characteristic)
    {
        $characteristic->delete();
        return response(null, 204);
    }
}
