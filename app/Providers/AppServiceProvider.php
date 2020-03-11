<?php

namespace App\Providers;

use App\Providers\TelescopeServiceProvider;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\User;
use App\Observers\SubCategoryObserver;
use App\Models\SubCategory;
use App\Observers\CategoryObserver;
use App\Models\Category;
use App\Observers\ProductObserver;
use App\Models\Product;
use App\Observers\ShippingsObserver;
use App\Models\Shipping;
use App\Observers\CharacteristicObserver;
use App\Models\Characteristic;
use App\Observers\PhotoObserver;
use App\Models\Photo;
use App\Observers\ConfigurationObserver;
use App\Models\Configuration;
use App\Observers\PhotoSlideObserver;
use App\Models\PhotoSlide;


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
        SubCategory::observe(SubCategoryObserver::class);
        Product::observe(ProductObserver::class);
        Shipping::observe(ShippingsObserver::class);
        Characteristic::observe(CharacteristicObserver::class);
        Photo::observe(PhotoObserver::class);
        Configuration::observe(ConfigurationObserver::class);
        PhotoSlide::observe(PhotoSlideObserver::class);
    }
}
