<?php

namespace App\Http\Resources\PhotoGallery;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhotoGalleryCollection extends ResourceCollection
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
            'data' => PhotoGalleryResource::collection($this->collection)
        ];   
    }
}
