<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\SubCategory;

class CategoryObserver
{
    /**
     * Handle the category "saving" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function saving(Category $category)
    {
        $category->name = e(strtolower($category->name));
        $category->slug = \Str::slug($category->name, '-');
        $category->description = e(strtolower($category->description));
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
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
