<?php

namespace App\Http\Resources\Photo;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PhotoCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => PhotoResource::collection($this->collection)
        ];   
    }
}
