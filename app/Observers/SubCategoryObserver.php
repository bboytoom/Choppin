<?php

namespace App\Observers;

use App\Models\SubCategory;
use App\Models\Product;

class SubCategoryObserver
{
    public function updated(SubCategory $subCategory)
    {
        if($subCategory->status == 0)
        {
            Product::where('subcategory_id', $subCategory->id)->update(['status' => 0]);
        }
        else
        {
            Product::where('subcategory_id', $subCategory->id)->update(['status' => 1]);
        }
    }
}
