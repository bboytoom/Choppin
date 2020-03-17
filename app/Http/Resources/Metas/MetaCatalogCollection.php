<?php

namespace App\Http\Resources\Metas;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MetaCatalogCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($element) {
            return [
                'keyword' => $element->keyword,
                'description' => $element->description
            ];
        });
    }
}
