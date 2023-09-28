<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Policies\ReplyPolicy;
use App\Policies\UserTicketPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Ticket::class => UserTicketPolicy::class,
        TicketReply::class => ReplyPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('user-ticket', [UserTicketPolicy::class, 'edit']);
        Gate::define('edit-reply', [ReplyPolicy::class, 'edit']);
    }
}
