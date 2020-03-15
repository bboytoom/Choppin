<?php

namespace App\Http\Resources\Shipping;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserIdentifierResource;

class ShippingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'street_one' => $this->street_one,
                'street_two' => $this->street_two,
                'addres' => $this->addres,
                'suburb' =>  $this->suburb,
                'town' => $this->town,
                'status' =>  $this->status,
                'state' => $this->state,
                'country' =>  $this->country,
                'postal_code' => $this->postal_code,
                'status' =>  $this->status
            ],
            'user' => new UserIdentifierResource($this->user)
        ];
    }
}
