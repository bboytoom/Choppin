<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\PhotoImageUpdated;
use App\Listeners\PhotoImageUpdatedListener;
use App\Events\PhotoGalleryUpdate;
use App\Listeners\PhotoGalleryUpdateListener;
use App\Events\PhotoSlideUpdate;
use App\Listeners\PhotoSlideUpdateListener;

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
        PhotoImageUpdated::class => [
            PhotoImageUpdatedListener::class,
        ],
        PhotoGalleryUpdate::class => [
            PhotoGalleryUpdateListener::class,
        ],
        PhotoSlideUpdate::class => [
            PhotoSlideUpdateListener::class,
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
