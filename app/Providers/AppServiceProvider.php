<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\User;
use App\Observers\SubCategoryObserver;
use App\Models\SubCategory;
use App\Observers\CategoryObserver;
use App\Models\Category;
use App\Observers\ProductObserver;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        SubCategory::observe(SubCategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
