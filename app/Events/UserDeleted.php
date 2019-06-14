<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

class UserDeleted
{
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The user that needs to be unsubscribed.
     *
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user The user that needs to be unsubscribed.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
