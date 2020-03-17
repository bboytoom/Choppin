<?php

namespace App\Http\Resources\Metas;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'keyword' => $this->keyword,
                'description' => $this->description
            ]
        ];
    }
}
