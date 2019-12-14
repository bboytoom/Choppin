<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserResource extends JsonResource
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
            'name' => $this->name,
            'mother_surname' => $this->mother_surname,
            'father_surname' => $this->father_surname,
            'email' => $this->email,
            'status' =>  $this->status
        ];
    }
}
