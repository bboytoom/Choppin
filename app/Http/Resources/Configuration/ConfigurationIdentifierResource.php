<?php

namespace App\Http\Resources\Configuration;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationIdentifierResource extends JsonResource
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
            'name' => $this->name
        ];
    }
}
