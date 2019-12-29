<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\SubCategory\SubCategoryCatalogCollection;
use App\Models\Category;

class ProductCollection extends ResourceCollection
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
            'data' => ProductResource::collection($this->collection)
        ];
    }

    public function with($request)
    {
        return [
            'categories' => new SubCategoryCatalogCollection(Category::all())
        ];
    }
}
