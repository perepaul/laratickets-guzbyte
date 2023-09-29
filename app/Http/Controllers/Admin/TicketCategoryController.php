<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Enums\TicketStatusEnum;
use App\Models\TicketDepartment;
use App\Actions\Ticket\FilterAction;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketCategories = TicketDepartment::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.ticket-category.index')->with([
            "ticket_catgories" => $ticketCategories,
            "sn" => 1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticket-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => ["required"]
        ]);
        $validator->validate();
        TicketDepartment::create([
            "name" => $request->category_name
        ]);
        return redirect()->route("admin.ticket.category")->with([
            "success" => $request->category_name." created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(request $request, string $id)
    {
        $ticketDepartment = TicketDepartment::findOrFail($id);
        $tickets = $ticketDepartment->ticket();
        $daterange = $request->daterange;
        $status = $request->statuses;
        $ticket_id = $request->ticket_id;
        $dateArr = null;
        if(!is_null($daterange)){
            $dateArr = explode(" to ", $daterange);
        }
        $tickets = FilterAction::run($dateArr, $tickets, $ticket_id, $status);
        return view('admin.ticket-category.show')->with([
            "category" => $ticketDepartment,
            "tickets" => $tickets->paginate(20),
            "StatusEnums" => TicketStatusEnum::class,
            "sn" => 1,
            "statuses" => $request->statuses,
            "daterange" => $daterange,
            "ticket_id" => $ticket_id,
            "dateArr" => $dateArr
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = TicketDepartment::findOrFail($id);
        return view('admin.ticket-category.edit')->with([
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => ["required"]
        ]);
        $validator->validate();
        $category = TicketDepartment::findOrFail($id);
        $category->update([
            "name" => $request->category_name
        ]);
        return redirect()->route("admin.ticket.category")->with([
            "success" => $request->category_name." updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticketCategory = TicketDepartment::findOrFail($id);
        $ticketCategory->update([
            "is_deleted" => true,
            "deleted_at" => Carbon::now()
        ]);
        return redirect()->back()->with([
            "Category is marked as deleted"
        ]);
    }

    public function restore(String $id){
        $ticketCategory = TicketDepartment::findOrFail($id);
        $ticketCategory->update([
            "is_deleted" => false,
            "deleted_at" => null
        ]);
        return redirect()->back()->with([
            "Category is restored successfully"
        ]);
    }
}
