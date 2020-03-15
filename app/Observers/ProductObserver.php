<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Characteristic;

class ProductObserver
{
    public function updated(Product $product)
    {
        if($product->status == 0)
        {
            Characteristic::where('product_id', $product->id)->update(['status' => 0]);
        }
        else
        {
            Characteristic::where('product_id', $product->id)->update(['status' => 1]);
        }
    }
}
