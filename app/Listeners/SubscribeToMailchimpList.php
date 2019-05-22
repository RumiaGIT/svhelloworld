<?php

namespace App\Listeners;

use App\Events\UserCreatedOrChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Newsletter;

class SubscribeToMailchimpList implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     */
    public function handle(UserCreatedOrChanged $event)
    {
        if (env('MAILCHIMP_APIKEY') === null || env('MAILCHIMP_LIST_ID') === null || env('MAILCHIMP_INTEREST_CATEGORY_ID') === null) {
            return;
        }

        if (! $event->user->user_category) {
            return;
        }

        $api = Newsletter::getApi();
        $list_id = env('MAILCHIMP_LIST_ID');
        $interest_category_id = env('MAILCHIMP_INTEREST_CATEGORY_ID');
        $result = $api->get("lists/${list_id}/interest-categories/${interest_category_id}/interests");

        if (! isset($result['interests']) || count($result['interests']) === 0) {
            return;
        }

        $interests = [];

        foreach ($result['interests'] as $interest) {
            $interests[$interest['id']] = ($event->user->user_category->mailchimp_interest_id === $interest['id']);
        }

        if (Newsletter::hasMember($event->user->email)) {
            $subscriber_hash = $api->subscriberHash($event->user->email);

            $api->patch("lists/${list_id}/members/${subscriber_hash}", [
                'interests' => $interests,
            ]);

            return;
        }

        Newsletter::subscribe($event->user->email, [
            'FNAME' => $event->user->first_name,
            'LNAME' => trim($event->user->name_prefix . ' ' . $event->user->last_name),
        ], '', [
            'interests' => $interests,
        ]);
    }
}
