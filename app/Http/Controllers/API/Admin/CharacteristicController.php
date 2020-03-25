<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CharacteristicRequest;
use App\Http\Resources\Characteristic\CharacteristicResource;
use App\Http\Resources\Characteristic\CharacteristicCollection;
use App\Repositories\CharacteristicRepository;
use App\Models\Characteristic;

class CharacteristicController extends Controller
{
    protected $charac;
    private $pages = 10;

    public function __construct(CharacteristicRepository $charac)
    {
        $this->authorizeResource(Characteristic::class, 'characteristic');
        $this->charac = $charac;
    }

    public function index($id)
    {
        $characteristics = Characteristic::whereHas('product', function ($characteristicsEstatus) {
            $characteristicsEstatus->where('status', 1); 
        })->where('product_id', $id)->paginate($this->pages);

        return new CharacteristicCollection($characteristics);
    }

    public function store(CharacteristicRequest $request)
    {
        return response(null,  $this->charac->createCharacteristic($request));
    }

    public function show(Characteristic $characteristic)
    {
        CharacteristicResource::withoutWrapping();
        return new CharacteristicResource($characteristic);
    }

    public function update(CharacteristicRequest $request, Characteristic $characteristic)
    {
        return response(null, $this->charac->updateCharacteristic($request, $characteristic));
    }

    public function destroy(Characteristic $characteristic)
    {
        return response(null, $this->charac->deleteCharacteristic($characteristic));
    }
}
