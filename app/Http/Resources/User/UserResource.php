<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'mother_surname' => $this->mother_surname,
                'father_surname' => $this->father_surname,
                'email' => $this->email,
                'status' =>  $this->status
            ]
        ];
    }
}
