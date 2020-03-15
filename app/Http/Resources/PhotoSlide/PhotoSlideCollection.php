<?php

namespace App\Http\Resources\PhotoSlide;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhotoSlideCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => PhotoSlideResource::collection($this->collection)
        ];  
    }
}
