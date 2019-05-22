<?php

namespace App\Listeners;

use App\Events\UserAppliedForActivity;
use App\Notifications\PaymentCreated as PaymentCreatedNotification;
use App\Payment;

class CreateActivityEntryPayment
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
    public function handle(UserAppliedForActivity $event)
    {
        // Create the payment
        $payment = new Payment();
        $payment->amount = $event->amount;
        $payment->description = $event->description;

        $payment->user()->associate($event->user);
        $payment->save();

        // Add payment to the activity
        $event->activity_entry->payments()->save($payment);

        // Send notification to user
        $event->user->notify(new PaymentCreatedNotification($payment->id));
    }
}
