<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuration;
use App\Models\InShoppingCart;
use App\Models\ShoppingCarts;
use App\Models\Shipping;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        $subtotal = 0;
        $products = array();
        $user = Auth::user();
        $shipping = Configuration::where('domain', $_SERVER['HTTP_HOST'])->first();
        $address = Shipping::find($this->shipping_address_id);
        $products_all = ShoppingCarts::firstWhere('id', $this->shopping_cart_id);

        foreach($products_all->products()->get() as $item) {
            $quantity = InShoppingCart::where('shopping_cart_id', $this->shopping_cart_id)->where('product_id', $item->id)->first();

            $products[] = array(
                'name' => $item->name,
                'extract' => $item->extract,
                'description' => $item->description,
                'price' => $item->price,
                'quantity' => $quantity->qty
            );

            $subtotal += $item->price * $quantity->qty; 
        }

        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'create_order' => $this->created_at,
                'contact' => [
                    'full_name' => $user->father_surname .  ' ' . $user->mother_surname . ' ' . $user->name,
                    'email' => $user->email
                ],
                'shipping_adrress' => [
                    'name_address' => $address->name,
                    'addres' => $address->addres,
                    'street_one' => $address->street_one,
                    'street_two' => $address->street_two,
                    'suburb' => $address->suburb,
                    'town' => $address->town,
                    'state' => $address->state,
                    'country_code' => $address->country_code,
                    'postal_code' => $address->postal_code,
                ],
                'products' => $products,
                'subtotal' => number_format($subtotal, 2),
                'shipping_base' => $shipping->cost_shipping,
                'status_order' => $this->status
            ]
        ];
    }
}
