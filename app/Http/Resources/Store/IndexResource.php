<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Photo\PhotoIdentifierResource;
use App\Models\Photo;

class IndexResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'extract' => $this->extract,
                'price' =>  $this->price,
            ],
            'image' => new PhotoIdentifierResource(Photo::where('product_id', $this->id)->first())
        ];
    }
}
