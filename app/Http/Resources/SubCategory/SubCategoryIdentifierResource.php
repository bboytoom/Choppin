<?php

namespace App\Http\Resources\SubCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryIdentifierResource extends JsonResource
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
            'categoryid' => $this->category_id,
            'name' => $this->name
        ];
    }
}
