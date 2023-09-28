<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        $user = auth()->user();
        $totalreplies = $user->replies()->count();
        return view('agent.dashboard')->with([
            "tickets" => $tickets,
            "open_ticket" => Ticket::openTicket()->count(),
            "total_replies" => $totalreplies
        ]);
    }
}
