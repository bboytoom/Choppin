<?php

namespace App\Http\Resources\Photo;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class PhotoCatalogCollection extends ResourceCollection
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
                'url' => Storage::disk('photo_big')->url($element->image),
            ];
        });
    }
}
