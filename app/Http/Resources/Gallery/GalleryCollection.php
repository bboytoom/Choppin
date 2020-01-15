<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Category\CategoryCatalogCollection;
use App\Models\Category;

class GalleryCollection extends ResourceCollection
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
            'data' => GalleryResource::collection($this->collection)
        ];
    }

    public function with($request)
    {
        return [
            'categories' => new CategoryCatalogCollection(Category::where('status', 1)->get())
        ];
    }
}
