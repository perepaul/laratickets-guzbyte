<?php

use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\ReplyController;
use App\Http\Controllers\Agent\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:agent', 'temp.password', 'auth'], 'prefix' => 'agent'], function(){
    Route::get("/", [AgentDashboardController::class, 'index'])->name('agent.dashboard');
    // Tickets
    Route::get("/tickets", [TicketController::class, 'index'])->name('agent.tickets');
    Route::get("/tickets/status/{ticket_id}", [TicketController::class, 'status'])->name('agent.tickets.status');
    Route::post("/tickets/status/{ticket_id}", [TicketController::class, 'updateStatus'])->name('agent.tickets.status.post');
    Route::get("/tickets/{ticket_id}", [TicketController::class, 'show'])->name('agent.tickets.show');

    //Reply
    Route::post("/tickets/reply/{ticket_id}", [ReplyController::class, 'store'])->name('agent.tickets.reply');
    Route::get("/tickets/edit/reply/{ticket_id}", [ReplyController::class, 'edit'])->name('agent.tickets.edit');
    Route::patch("/tickets/edit/update/{ticket_id}", [ReplyController::class, 'update'])->name('agent.tickets.update');
});
