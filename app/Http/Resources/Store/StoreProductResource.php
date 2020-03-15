<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Photo\PhotoCatalogCollection;

class StoreProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'extract' => $this->extract,
                'description' =>  $this->description,
                'price' =>  $this->price,
            ],
            'images' => new PhotoCatalogCollection($this->image)
        ];
    }
}
