<?php

namespace App\Policies;

use App\Subscription;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the subscription.
     *
     * @return mixed
     */
    public function view(User $user, Subscription $subscription)
    {
        return $user->id === $subscription->user_id;
    }

    /**
     * Determine whether the user can create subscriptions.
     *
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the subscription.
     *
     * @return mixed
     */
    public function update(User $user, Subscription $subscription)
    {
        return $user->id === $subscription->user_id;
    }

    /**
     * Determine whether the user can delete the subscription.
     *
     * @return mixed
     */
    public function delete(User $user, Subscription $subscription)
    {
        return $user->id === $subscription->user_id;
    }
}
