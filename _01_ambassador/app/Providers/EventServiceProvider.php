<?php

namespace App\Providers;

use App\Events\ProductUpdatedEvent;
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
    ];

    public function boot(): void
    {
        //
    }
}
