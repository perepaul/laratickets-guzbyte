<?php

namespace App\Http\Controllers\User;

use App\Actions\Ticket\ReplyAction;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class RaiseTicketController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $tickets = $user->ticket()->get();
        return view('users.tickets.index')->with([
            "tickets" => $tickets,
            "sn" => 1
        ]);
    }

    public function show(String $id)
    {
        $ticket = Ticket::findorFail($id);
        if(Gate::denies('user-ticket', $ticket)){
            abort(403);
        }
        $replies = $ticket->replies()->get();
        return view("users.tickets.show")->with([
            "ticket" => $ticket,
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
        ReplyAction::run($request, $ticket);
        return redirect()->back()->with([
            "success" => "Your reply has been sent an agent we be in touch in no time."
        ]);
    }



    public function create()
    {
        $department = TicketDepartment::whereIsDeleted(0)->get();
        return view('users.tickets.create')->with([
            "department" => $department,
            
        ]);
    }

    public function edit($id)
    {

        $ticket = Ticket::findorFail($id);
        if(Gate::denies('user-ticket', $ticket)){
            abort(403);
        }
        $department = TicketDepartment::all();
        return view('users.tickets.edit')->with([
            "ticket" => $ticket,
            "department" => $department,
        ]);
    }

    public function update(Request $request, String $id){
        $ticket = Ticket::findOrFail($id);
        if(Gate::denies('user-ticket', $ticket)){
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            "category" => ["required"],
            "subject" => ["required"],
            "body" => ["required"],
            "attachment" => ["nullable","mimes:png,jpg,docx,pdf"]
        ]);
        $validator->validate();
        if($request->hasFile('attachment')){
            $attachment = "attac_".time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('/attachment'), $attachment);
            $attachment = "attachment/".$attachment;
        }
        $tracking_id = generateTicketId();
        $user = auth()->user();
        $ticket->update([
            "ticket_department_id" => $request->category,
            "subject" => $request->subject,
            "body" => $request->body,
            "attachment" => $attachment ?? null
        ]);
        return redirect()->back()->with([
            "success" => "Ticket updated successfully an agent will get in touch shortly"
        ]);

    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "category" => ["required"],
            "subject" => ["required"],
            "body" => ["required"],
            "attachment" => ["nullable","mimes:png,jpg,docx,pdf"]
        ]);
        $validator->validate();
        if($request->hasFile('attachment')){
            $attachment = "attac_".time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('/attachment'), $attachment);
            $attachment = "attachment/".$attachment;
        }
        $tracking_id = generateTicketId();
        $user = auth()->user();
        $user->ticket()->create([
            "tracking_id" => $tracking_id,
            "ticket_department_id" => $request->category,
            "subject" => $request->subject,
            "body" => $request->body,
            "attachment" => $attachment ?? null
        ]);
        return redirect()->back()->with([
            "success" => "Ticket submitted successfully an agent will get in touch shortly"
        ]);
    }
}
