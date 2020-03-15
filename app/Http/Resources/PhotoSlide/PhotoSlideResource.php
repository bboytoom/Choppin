<?php

namespace App\Http\Resources\PhotoSlide;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PhotoSlideResource extends JsonResource
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
            'url' => Storage::disk('slide')->url($this->image)
        ];
    }
}
