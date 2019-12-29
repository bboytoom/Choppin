<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryIdentifierResource;
use App\Http\Resources\SubCategory\SubCategoryIdentifierResource;
use App\Http\Resources\SubCategory\SubCategoryCatalogCollection;
use App\Http\Resources\Characteristic\CharacteristicCatalogCollection;
use App\Models\Category;

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
                'status' =>  $this->status
            ],
            'subcategory' => new SubCategoryIdentifierResource($this->subcategory)
        ];
    }
}
