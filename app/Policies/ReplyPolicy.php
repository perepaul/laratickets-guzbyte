<?php

namespace App\Policies;

use App\Models\TicketReply;
use App\Models\User;

class ReplyPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, TicketReply $reply)
    {
        return $user->id === $reply->user_id;
    }
}
