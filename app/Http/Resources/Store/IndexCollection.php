<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\SubCategory\SubCategoryCatalogCollection;
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
            'slide' => new PhotoSlideCatalogCollection(PhotoSlide::where('status', 1)->get()),
            'categories' => new SubCategoryCatalogCollection(Category::where('status', 1)->get())
        ];
    }
}
