<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\Categoryupdated;
use App\Listeners\CategoryUpdatedListener;
use App\Events\Userupdated;
use App\Listeners\UserUpdatedListener;
use App\Events\Productupdated;
use App\Listeners\ProductUpdatedListener;
use App\Events\SubCategoryupdated;
use App\Listeners\SubCategoryUpdatedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Categoryupdated::class => [
            CategoryUpdatedListener::class,
        ],
        Userupdated::class => [
            UserUpdatedListener::class,
        ],
        Productupdated::class => [
            ProductUpdatedListener::class,
        ],
        SubCategoryupdated::class => [
            SubCategoryUpdatedListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
