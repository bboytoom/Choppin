<?php

namespace App\Http\Resources\Photo;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class PhotoCatalogCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($element) {
            return [
                'id' => $element->id,
                'src' => Storage::disk('photo_big')->url($element->image),
                'thumbnail' => Storage::disk('photo_small')->url($element->image),
                'alt' => $element->name
            ];
        });
    }
}
