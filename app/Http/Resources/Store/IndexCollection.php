<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\SubCategory\SubCategoryCatalogCollection;
use App\Http\Resources\PhotoSlide\PhotoSlideCatalogCollection;
use App\Http\Resources\Metas\MetaCatalogCollection;
use App\Models\Category;
use App\Models\PhotoSlide;
use App\Models\Metas;

class IndexCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => IndexResource::collection($this->collection)
        ];
    }

    public function with($request)
    {
        return [
            'metas' => new MetaCatalogCollection(Metas::all()),
            'slide' => new PhotoSlideCatalogCollection(PhotoSlide::where('status', 1)->get()),
            'categories' => new SubCategoryCatalogCollection(Category::where('status', 1)->get())
        ];
    }
}
