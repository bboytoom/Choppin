<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminUserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($elemento)
                {
                    return [
                        'id' => $elemento->id,
                        'name' => $elemento->name,
                        'mother_surname' => $elemento->mother_surname,
                        'father_surname' => $elemento->father_surname,
                        'email' => $elemento->email,
                        'status' =>  $elemento->status
                    ];
                }
            )
        ];
    }
}
