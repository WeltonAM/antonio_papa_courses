<?php

namespace App\Listeners;

use App\Events\OrderCompletedEvent;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class NotifyAdminListener
{
    public function handle(OrderCompletedEvent $event)
    {
        $order = $event->order;

        Mail::send('admin', [
            'order' => $order,
        ], function(Message $message) {
            $message->subject('The Order has been completed!');

            $message->to('admin@admin.com');
        });
    }
}
