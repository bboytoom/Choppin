<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SubCategory\SubCategoryIdentifierResource;

class ProductResource extends JsonResource
{
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
