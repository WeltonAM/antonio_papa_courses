<?php

namespace App\Listeners;

use App\Events\ProductUpdatedEvent;
use Illuminate\Support\Facades\Cache;

class ProductUpdatedListener
{
    public function handle(ProductUpdatedEvent $event)
    {
        Cache::forget('products.frontend');
        Cache::forget('products.backend');
    }
}
