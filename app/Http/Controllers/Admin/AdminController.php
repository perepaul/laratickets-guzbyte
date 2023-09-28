<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all()->take(20);
        return view('admin.dashboard')->with([
            "tickets" => $tickets,
            "closed_ticket" => Ticket::closedTicket()->count(),
            "open_ticket" => Ticket::openTicket()->count(),
            "on_hold_ticket" => Ticket::onHoldTicket()->count(),
            "solved_ticket" => Ticket::solvedTicket()->count(),
            "sn" => 1
        ]);
    }
}
