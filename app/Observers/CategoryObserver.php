<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\SubCategory;

class CategoryObserver
{
    public function creating(Category $category)
    {
        $category->name = e(strtolower($category->name));
        $category->slug = \Str::slug($category->name, '-');
        $category->description = e(strtolower($category->description));
        $category->status = 1;
    }

    public function updating(Category $category)
    {
        $category->name = e(strtolower($category->name));
        $category->slug = \Str::slug($category->name, '-');
        $category->description = e(strtolower($category->description));
        $category->status = $category->status;
    }

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
