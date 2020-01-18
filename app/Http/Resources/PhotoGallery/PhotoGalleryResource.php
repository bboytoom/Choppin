<?php

namespace App\Http\Resources\PhotoGallery;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Gallery\GalleryIdentifierResource;
use Illuminate\Support\Facades\Storage;

class PhotoGalleryResource extends JsonResource
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
                'image' => $this->image,
                'description' => $this->description,
                'status' => $this->status
            ],
            'url' => Storage::disk('slide')->url($this->image),
            'gallery' => new GalleryIdentifierResource($this->gallery)
        ];
    }
}
