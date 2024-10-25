<?php

namespace App\Providers;

use App\Events\OrderCompletedEvent;
use App\Events\ProductUpdatedEvent;
use App\Listeners\NotifyAdminListener;
use App\Listeners\NotifyAmbassadorListener;
use App\Listeners\ProductUpdatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            // SendEmailVerificationNotification::class,
        ],
        ProductUpdatedEvent::class => [
            ProductUpdatedListener::class,
        ],
        OrderCompletedEvent::class => [
            NotifyAdminListener::class,
            NotifyAmbassadorListener::class
        ],
    ];

    public function boot(): void
    {
        //
    }
}
