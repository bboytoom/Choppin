<?php

namespace App\Http\Resources\SubCategory;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryIdentifierResource;

class SubCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'status' =>  $this->status
            ],
            'category' => new CategoryIdentifierResource($this->category)
        ];
    }
}
