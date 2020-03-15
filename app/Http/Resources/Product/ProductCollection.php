<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\SubCategory\SubCategoryCatalogCollection;
use App\Models\Category;

class ProductCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => ProductResource::collection($this->collection)
        ];
    }

    public function with($request)
    {
        return [
            'categories' => new SubCategoryCatalogCollection(Category::where('status', 1)->get())
        ];
    }
}
