<?php

namespace App\Http\Resources\Characteristic;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CharacteristicCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => CharacteristicResource::collection($this->collection)
        ];
    }
}
