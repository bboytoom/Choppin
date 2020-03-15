<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\SubCategory;

class CategoryObserver
{
    public function updated(Category $category)
    {
        if($category->status == 0)
        {
            SubCategory::where('category_id', $category->id)->update(['status' => 0]);
        }
        else
        {
            SubCategory::where('category_id', $category->id)->update(['status' => 1]);
        }
    }
}
