<?php

namespace App\Observers;

use App\Models\SubCategory;
use App\Models\Product;

class SubCategoryObserver
{
    public function creating(SubCategory $subCategory)
    {
        $subCategory->name = e(strtolower($subCategory->name));
        $subCategory->slug = \Str::slug($subCategory->name, '-');
        $subCategory->description = e(strtolower($subCategory->description));
        $subCategory->status = 1;
    }

    public function updating(SubCategory $subCategory)
    {
        $subCategory->name = e(strtolower($subCategory->name));
        $subCategory->slug = \Str::slug($subCategory->name, '-');
        $subCategory->description = e(strtolower($subCategory->description));
        $subCategory->status = $subCategory->status;
    }

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
