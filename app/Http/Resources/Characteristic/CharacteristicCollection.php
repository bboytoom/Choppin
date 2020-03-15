<?php

namespace App\Http\Resources\Characteristic;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CharacteristicCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => CharacteristicResource::collection($this->collection)
        ];
    }
}
