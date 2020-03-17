<?php

namespace App\Http\Resources\Metas;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MetaCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => MetaResource::collection($this->collection)
        ]; 
    }
}
