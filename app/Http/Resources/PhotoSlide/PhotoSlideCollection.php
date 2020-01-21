<?php

namespace App\Http\Resources\PhotoSlide;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhotoSlideCollection extends ResourceCollection
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
            'data' => PhotoSlideResource::collection($this->collection)
        ];  
    }
}
