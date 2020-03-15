<?php

namespace App\Http\Resources\Configuration;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ConfigurationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => ConfigurationResource::collection($this->collection)
        ];
    }
}
