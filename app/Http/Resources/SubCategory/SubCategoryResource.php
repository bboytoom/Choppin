<?php

namespace App\Http\Resources\SubCategory;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin\AdminIdentifierResource;
use App\Http\Resources\Category\CategoryIdentifierResource;
use App\Http\Resources\Category\CategoryCatalogCollection;
use App\Models\Category;

class SubCategoryResource extends JsonResource
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
                'description' => $this->description,
                'status' =>  $this->status,
            ],
            'relationsships' => [
                'admin' => new AdminIdentifierResource($this->admins),
                'category' => new CategoryIdentifierResource($this->category)
            ],
            'catalogs' => [
                'categories' => new CategoryCatalogCollection(Category::all())
            ]
        ];
    }
}
