<?php

namespace Shop\Billing\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //mocking
        logger('Order id ' . $event->order->id . ' just created. We send an email to ' . $event->order->customer->user->email);
    }
}
