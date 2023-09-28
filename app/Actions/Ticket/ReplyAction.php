<?php

namespace App\Actions\Ticket;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class ReplyAction {

    public static function run(Request $request, Ticket $ticket, bool $is_agent=false){
        if($request->hasFile('attachment')){
            $attachment = "attac_".time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('/attachment'), $attachment);
            $attachment = "attachment/".$attachment;
        }
        $reply = $request->reply;
        $ticket->replies()->create([
            'user_id' => auth()->user()->id,
            'message' => $reply,
            'attachment' => $attachment ?? null,
            'is_agent_reply' => $is_agent
        ]);
        return true;
    }

    public static function updateReply(Request $request, TicketReply $reply){
        $attachment = $reply->attachment;
        if($request->hasFile('attachment')){
            $attachment = "attac_".time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('/attachment'), $attachment);
            $attachment = "attachment/".$attachment;
        }
        $message = $request->message;
        $reply->update([
            'message' => $message,
            'attachment' => $attachment ?? null,
        ]);
        return true;
    }

}