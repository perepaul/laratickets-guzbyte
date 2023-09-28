<?php

use App\Http\Controllers\User\RaiseTicketController;
use App\Http\Controllers\User\ReplyController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:user', 'temp.password']], function(){
    Route::get("/dashboard", [UserDashboardController::class, 'index'])->name("user.dashboard");

    //Ticket
    Route::get("/my-tickets", [RaiseTicketController::class, 'index'])->name('user.tickets');
    Route::get("/my-ticket/show/{user_id}", [RaiseTicketController::class, 'show'])->name('user.tickets.show');
    Route::get("/my-ticket/edit/{user_id}", [RaiseTicketController::class, 'edit'])->name('user.tickets.edit');
    Route::patch("/my-ticket/update/{user_id}", [RaiseTicketController::class, 'update'])->name('user.tickets.update');
    Route::get("/raise-ticket", [RaiseTicketController::class, 'create'])->name('user.raise.ticket');
    Route::post("/raise-ticket", [RaiseTicketController::class, 'store'])->name('user.raise.ticket.store');
    
    //Reply
    Route::post("/my-ticket/reply/{user_id}", [ReplyController::class, 'store'])->name('user.tickets.reply');
    Route::get("/my-ticket/edit/reply/{ticket_id}", [ReplyController::class, 'edit'])->name('user.tickets.reply.edit');
    Route::patch("/my-ticket/edit/update/{ticket_id}", [ReplyController::class, 'update'])->name('user.tickets.reply.update');
    

});
