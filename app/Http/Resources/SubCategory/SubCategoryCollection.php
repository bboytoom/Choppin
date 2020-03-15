<?php

namespace App\Http\Resources\SubCategory;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Category\CategoryCatalogCollection;
use App\Models\Category;

class SubCategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => SubCategoryResource::collection($this->collection)
        ];
    }

    public function with($request)
    {
        return [
            'categories' => new CategoryCatalogCollection(Category::where('status', 1)->get())
        ];
    }
}
