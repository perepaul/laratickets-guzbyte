<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Authentication\RegisterAction;
use Illuminate\Http\Request;
use App\Models\TicketDepartment;
use App\Http\Controllers\Controller;
use App\Jobs\EmailAgentJob;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sn = 1;
        $agents = User::agents()->get();
        return view("admin.agents.index")->with([
            'sn' => 1,
            "agents" => $agents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = TicketDepartment::all();
        return view('admin.agents.create')->with([
            "departments" => $department
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => ['required'],
            "email" => ['required', 'email', 'unique:users'],
            "department" => ['required']
        ]);
        $validate->validate();
        $user = RegisterAction::run([
            "name" => $request->name,
            "email" => $request->email,
            "role" => 'agent'
        ]);        
        $tempPass = $user["temp_password"];
        // $user = User::find()
        $user->department()->create([
            "ticket_department_id" => $request->department
        ]);
        dispatch(new EmailAgentJob([
            'email' => $request->email,
            'temp_password' => $tempPass
        ]));
        return redirect()->back()->with([
            "success" => "Agent created successfully. Agent Login details has been sent to the email provided"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agent = User::findOrFail($id);
        
        $repliesByTicket = TicketReply::with('ticket')->get()->groupBy('ticket_id');
        return view("admin.agents.show")->with([
            "agent" => $agent,
            "repliesByTicket" => $repliesByTicket
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent = User::findOrFail($id);
        $department = TicketDepartment::all();
        return view("admin.agents.edit")->with([
            "agent" => $agent,
            "departments" => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            "name" => ['required'],
            "email" => ['required', 'email'],
            "department" => ['required']
        ]);
        $validate->validate();
        $agent = User::findOrFail($id);        
        // $user = User::find()
        $agent->department()->update([
            "ticket_department_id" => $request->department
        ]);
        $agent->update($validate->validated());
        return redirect()->back()->with([
            "success" => "Agent Updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agent = User::findOrFail($id);
        $agent->delete();
        return redirect()->back()->with([
            "success" => "Agent deleted successfully"
        ]);
    }
}
