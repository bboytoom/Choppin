<?php

namespace App\Http\Resources\SubCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SubCategoryCatalogCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($element) {
            return [
                'id' => $element->id,
                'name' => $element->name,
                'subcategories' => SubCategoryIdentifierResource::collection($element->subcategory)
            ];
        });
    }
}
