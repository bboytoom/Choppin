<?php

namespace App\Http\Resources\Shipping;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ShippingCatalogCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($element) {
            return [
                'id' => $element->id,
                'street_one' => $element->street_one,
                'street_two' => $element->street_two,
                'addres' => $element->addres,
                'suburb' => $element->suburb,
                'town' => $element->town,
                'state' => $element->state,
                'country' => $element->country,
                'postal_code' => $element->postal_code
            ];
        });
    }
}
