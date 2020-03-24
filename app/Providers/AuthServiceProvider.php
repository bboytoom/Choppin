<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Characteristic' => 'App\Policies\CharacteristicPolicy',
        'App\Models\Configuration' => 'App\Policies\ConfigurationPolicy',
        'App\Models\Metas' => 'App\Policies\MetasPolicy',
        'App\Models\Permission' => 'App\Policies\PermissionPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Shipping' => 'App\Policies\ShippingPolicy',
        'App\Models\SubCategory' => 'App\Policies\SubCategoryPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
