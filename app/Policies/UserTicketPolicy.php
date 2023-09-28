<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class UserTicketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

   

    public function edit(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id;
    }

}
