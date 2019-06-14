<?php

namespace App\Listeners;

use App\Events\SubscriptionApproved;
use App\Notifications\SubscriptionApproved as SubscriptionApprovedNotification;

class SendSubscriptionApprovedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(SubscriptionApproved $event)
    {
        $subscription_id = $event->subscription->id;
        $period_name = $event->subscription->contribution->period->name;

        $event->user->notify(new SubscriptionApprovedNotification($subscription_id, $period_name));
    }
}
