<?php

namespace App\Http\Resources\Photo;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Product\ProductIdentifierResource;
use Illuminate\Support\Facades\Storage;

class PhotoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'image' => $this->image,
                'description' => $this->description,
                'status' => $this->status
            ],
            'url' => Storage::disk('photo_small')->url($this->image),
            'product' => new ProductIdentifierResource($this->product)
        ];
    }
}
