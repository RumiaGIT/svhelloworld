<?php

namespace App\Listeners;

use App\Events\SubscriptionApproved;
use App\Notifications\PaymentCreated as PaymentCreatedNotification;
use App\Payment;

class CreateSubscriptionPayment
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
        // Create the payment
        $payment = new Payment();
        $payment->amount = $event->amount;
        $payment->description = $event->description;

        $payment->user()->associate($event->user);
        $payment->save();

        // Add payment to the contribution
        $event->subscription->payments()->save($payment);

        // Send notification to user
        $event->user->notify(new PaymentCreatedNotification($payment->id));
    }
}
