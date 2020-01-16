<?php

namespace App\Observers;

use App\Models\SubCategory;
use App\Models\Product;

class SubCategoryObserver
{
    /**
     * Handle the sub category "saving" event.
     *
     * @param  \App\SubCategory  $subCategory
     * @return void
     */
    public function saving(SubCategory $subCategory)
    {
        $subCategory->name = e(strtolower($subCategory->name));
        $subCategory->slug = \Str::slug($subCategory->name, '-');
        $subCategory->description = e(strtolower($subCategory->description));
    }

    /**
     * Handle the sub category "updated" event.
     *
     * @param  \App\SubCategory  $subCategory
     * @return void
     */
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
