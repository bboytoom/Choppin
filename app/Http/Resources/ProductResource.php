<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use App\Models\SubCategory;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'extract' => $this->extract,
                'description' =>  $this->description,
                'price' =>  $this->price,
                'image' =>  $this->image,
                'status' =>  $this->status,
            ],
            'relationsships' => [
                'admin' => new AdminIdentifierResource($this->admins),
                'category' => new CategoryIdentifierResource($this->category),
                'subcategory' => new SubCategoryIdentifierResource($this->subcategory)
            ],
            'catalogs' => [
                'categories' => new CategoryCatalogCollection(Category::all()),
                'subcategories' => new SubCategoryCatalogCollection(SubCategory::all())
            ]
        ];
    }
}
