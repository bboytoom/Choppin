<?php

namespace App\Http\Resources\Characteristic;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductIdentifierResource;

class CharacteristicResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'description' =>  $this->description,
                'status' =>  $this->status
            ],
            'product' => new ProductIdentifierResource($this->product)
        ];
    }
}
