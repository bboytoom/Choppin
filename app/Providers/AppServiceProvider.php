<?php

namespace App\Providers;

use App\Providers\TelescopeServiceProvider;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\User;
use App\Observers\GalleryObserver;
use App\Models\Gallery;
use App\Observers\SubCategoryObserver;
use App\Models\SubCategory;
use App\Observers\CategoryObserver;
use App\Models\Category;
use App\Observers\ProductObserver;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Category::observe(CategoryObserver::class);
        Gallery::observe(GalleryObserver::class);
        SubCategory::observe(SubCategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
