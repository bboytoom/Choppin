<?php

namespace App\Http\Resources\Characteristic;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CharacteristicCatalogCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($element) {
            return [
                'id' => $element->id,
                'name' => $element->name,
                'description' => $element->description
            ];
        });
    }
}
