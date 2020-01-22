<?php

namespace App\Http\Resources\PhotoSlide;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class PhotoSlideCatalogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($element) {
            return [
                'name' => $element->name,
                'description' => $element->description,
                'url' => Storage::disk('slide')->url($element->image),
            ];
        });
    }
}
