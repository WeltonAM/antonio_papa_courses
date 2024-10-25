<?php

namespace App\Listeners;

use App\Events\OrderCompletedEvent;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class NotifyAmbassadorListener
{
    public function handle(OrderCompletedEvent $event)
    {
        $order = $event->order;

        Mail::send('ambassador', [
            'order' => $order,
        ], function(Message $message) use ($order) {
            $message->subject('The Order has been completed!');

            $message->to($order->ambassador_email);
        });
    }
}
