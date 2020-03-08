<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Characteristic;

class ProductObserver
{
    public function creating(Product $product)
    {
        $product->name = e(strtolower($product->name));
        $product->slug = \Str::slug($product->name, '-');
        $product->extract = e(strtolower($product->extract));
        $product->description = e(strtolower($product->description));
        $product->price = e(strtolower($product->price));
        $product->status = 1;
    }

    public function updating(Product $product)
    {
        $product->name = e(strtolower($product->name));
        $product->slug = \Str::slug($product->name, '-');
        $product->extract = e(strtolower($product->extract));
        $product->description = e(strtolower($product->description));
        $product->price = e(strtolower($product->price));
        $product->status = $product->status;
    }
   
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
