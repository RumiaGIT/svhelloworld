<?php

namespace App\Policies;

use App\ActivityEntry;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityEntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the activityEntry.
     *
     * @return mixed
     */
    public function view(User $user, ActivityEntry $activity_entry)
    {
        return $user->id === $activity_entry->user_id;
    }

    /**
     * Determine whether the user can create activityEntries.
     *
     * @return mixed
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the activityEntry.
     *
     * @return mixed
     */
    public function update(User $user, ActivityEntry $activity_entry)
    {
        return $user->id === $activity_entry->user_id;
    }

    /**
     * Determine whether the user can delete the activityEntry.
     *
     * @return mixed
     */
    public function delete(User $user, ActivityEntry $activity_entry)
    {
        return $user->id === $activity_entry->user_id;
    }
}
