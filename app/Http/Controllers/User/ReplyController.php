<?php

namespace App\Http\Controllers\User;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use App\Actions\Ticket\ReplyAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class ReplyController extends Controller
{

    public function edit(String $id){
        $reply = TicketReply::findOrFail($id);
        if(Gate::denies('edit-reply', $reply)){
            abort(403);
        }
        $ticket = $reply->ticket;
        return view('users.tickets.reply.edit')->with([
            "ticket"  => $ticket,
            "reply" => $reply
        ]);
    }

    public function update(Request $request, String $id){
        $reply = TicketReply::findOrFail($id);
        if(Gate::denies('edit-reply', $reply)){
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            "message" => ["required"],
            "attachment" => ["nullable", "mimes:png,jpg,doc,docx,pdf"]
        ]);
        $validator->validate();
        ReplyAction::updateReply($request, $reply);
        return redirect()->route("user.tickets.show", [$reply->ticket->id])->with([
            "success" => "Your reply was updated successfully"
        ]);
    }

    public function store(Request $request, String $id)
    {
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
}
