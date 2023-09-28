<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Ticket\FilterAction;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $tickets = Ticket::query();
        $daterange = $request->daterange;
        $status = $request->statuses;
        $ticket_id = $request->ticket_id;
        $dateArr = null;
        if(!is_null($daterange)){
            $dateArr = explode(" to ", $daterange);
        }
        $tickets = FilterAction::run($dateArr, $tickets, $ticket_id, $status);
        return view('admin.tickets.index')->with([
            "tickets" => $tickets->paginate(20),
            "StatusEnums" => TicketStatusEnum::class,
            "sn" => 1,
            "statuses" => $request->statuses,
            "daterange" => $daterange,
            "ticket_id" => $ticket_id,
            "dateArr" => $dateArr
        ]);
    }


    public function show(String $id)
    {
        $ticket = Ticket::findorFail($id);
        $replies = $ticket->replies()->get();   
        return view('admin.tickets.show')->with([
            "ticket" => $ticket,
            "StatusEnums" => TicketStatusEnum::class,
            "replies" => $replies
        ]);
    }
}
