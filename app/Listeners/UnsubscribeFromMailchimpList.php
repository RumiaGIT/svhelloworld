<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Newsletter;

class UnsubscribeFromMailchimpList implements ShouldQueue
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
    public function handle(UserDeleted $event)
    {
        if (env('MAILCHIMP_APIKEY') === null || env('MAILCHIMP_LIST_ID') === null || env('MAILCHIMP_INTEREST_CATEGORY_ID') === null) {
            return;
        }

        $api = Newsletter::getApi();
        $list_id = env('MAILCHIMP_LIST_ID');
        $interest_category_id = env('MAILCHIMP_INTEREST_CATEGORY_ID');
        $subscriber_hash = $api->subscriberHash($event->user->email);

        $result = $api->get("lists/${list_id}/interest-categories/${interest_category_id}/interests");
        if (! isset($result['interests']) || count($result['interests']) === 0) {
            return;
        }

        $interests = [];
        foreach ($result['interests'] as $interest) {
            $interests[$interest['id']] = false;
        }

        $api->patch("lists/${list_id}/members/${subscriber_hash}", [
            'interests' => $interests,
        ]);
    }
}
