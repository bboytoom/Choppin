<?php

namespace App\Http\Resources\Gallery;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category\CategoryIdentifierResource;

class GalleryResource extends JsonResource
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
                'active' =>  $this->active,
                'status' =>  $this->status
            ],
            'category' => new CategoryIdentifierResource($this->category)
        ];
    }
}
