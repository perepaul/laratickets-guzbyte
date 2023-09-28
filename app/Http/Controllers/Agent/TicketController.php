<?php

namespace App\Http\Controllers\Agent;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Enums\TicketStatusEnum;
use Illuminate\Support\Facades\DB;
use App\Actions\Ticket\ReplyAction;
use App\Actions\Ticket\FilterAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        return view('agent.tickets.index')->with([
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
        return view("agent.tickets.show")->with([
            "ticket" => $ticket,
            "StatusEnums" => TicketStatusEnum::class,
            "replies" => $replies
        ]);
    }

    public function reply(Request $request, String $id){    
        $ticket = Ticket::findOrFail($id);
        $validator = Validator::make($request->all(), [
            "reply" => ["required"],
            "attachment" => ["nullable", "mimes:png,jpg,doc,docx,pdf"]
        ]);
        $validator->validate();
        ReplyAction::run($request, $ticket, true);
        // if($request->hasFile('attachment')){
        //     $attachment = "attac_".time().'.'.$request->attachment->getClientOriginalExtension();
        //     $request->attachment->move(public_path('/attachment'), $attachment);
        //     $attachment = "attachment/".$attachment;
        // }
        // $reply = $request->reply;
        // $ticket->replies()->create([
        //     'user_id' => auth()->user()->id,
        //     'message' => $reply,
        //     'attachment' => $attachment ?? null,
        //     'is_agent_reply' => true
        // ]);
        return redirect()->back()->with([
            "success" => "ticket replied Successfully"
        ]);
    }

    public function status(String $id)
    {
        $ticket = Ticket::findorFail($id);
        return view("agent.tickets.status")->with([
            "ticket" => $ticket,
            "StatusEnums" => TicketStatusEnum::class
        ]);
    }

    public function updateStatus(Request $request, String $id){
        $validator = Validator::make($request->all(), [
            "statuses" => ["required"]
        ]);
        $validator->validate();
        $status = $request->statuses;
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            "status" => $status
        ]);
        return redirect()->back()->with([
            "success" => "Ticket Status Updated Successfuly"
        ]);
    }


}
