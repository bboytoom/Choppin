<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Category\CategoryCatalogCollection;
use App\Http\Resources\PhotoSlide\PhotoSlideCatalogCollection;
use App\Models\Category;
use App\Models\PhotoSlide;

class IndexCollection extends ResourceCollection
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
            'data' => IndexResource::collection($this->collection)
        ];
    }

    public function with($request)
    {
        return [
            'categories' => new CategoryCatalogCollection(Category::where('status', 1)->get()),
            'slide' => new PhotoSlideCatalogCollection(PhotoSlide::where('status', 1)->get()),
        ];
    }
}
