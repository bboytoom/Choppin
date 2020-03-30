<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
                'full_name' => $this->father_surname . ' ' . $this->mother_surname . ' ' . $this->name,
                'email' => $this->email
            ],
            'permissions' => [
                'name' => $this->permission->name,
                'permissio' => $this->permission->permission
            ]
        ];
    }
}
