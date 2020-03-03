<?php

namespace App\Observers;

use App\Models\Shipping;

class ShippingsObserver
{
    public function creating(Shipping $shipping)
    {
        $shipping->street_one = e(strtolower($shipping->street_one));
        $shipping->street_two = e(strtolower($shipping->street_two));
        $shipping->addres = e(strtolower($shipping->addres));
        $shipping->suburb = e(strtolower($shipping->suburb));
        $shipping->town = e(strtolower($shipping->town));
        $shipping->state = e(strtolower($shipping->state));
        $shipping->country = e(strtolower($shipping->country));
        $shipping->postal_code = e(strtolower($shipping->postal_code));
        $shipping->status = 1;
    }

    public function updating(Shipping $shipping)
    {
        $shipping->street_one = e(strtolower($shipping->street_one));
        $shipping->street_two = e(strtolower($shipping->street_two));
        $shipping->addres = e(strtolower($shipping->addres));
        $shipping->suburb = e(strtolower($shipping->suburb));
        $shipping->town = e(strtolower($shipping->town));
        $shipping->state = e(strtolower($shipping->state));
        $shipping->country = e(strtolower($shipping->country));
        $shipping->postal_code = e(strtolower($shipping->postal_code));
    }
}
