<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\TicketCategoryController;
use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'role:admin', 'temp.password'], 'prefix' => 'admin'], function(){
    Route::get("/", [AdminController::class, 'index'])->name('admin.dashboard');
    //Agents
    Route::get('/agent', [AgentController::class, 'index'])->name('admin.agents');
    Route::get('/agent/show/{user_id}', [AgentController::class, 'show'])->name('admin.agents.show');
    Route::get('/agent/delete/{user_id}', [AgentController::class, 'destroy'])->name('admin.agents.delete');
    Route::get('/agent/edit/{user_id}', [AgentController::class, 'edit'])->name('admin.agents.edit');
    Route::patch('/agent/update/{user_id}', [AgentController::class, 'update'])->name('admin.agents.update');
    Route::get('/agent/create', [AgentController::class, 'create'])->name('admin.agent.create');
    Route::post('/agent/create', [AgentController::class, 'store'])->name('admin.agent.store');

    //Ticket
    Route::get('/tickets', [TicketController::class, 'index'])->name('admin.ticket');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');

    //Ticket Categories

    Route::get('/tickets-categories', [TicketCategoryController::class, 'index'])->name('admin.ticket.category');
    Route::get('/tickets-categories/create', [TicketCategoryController::class, 'create'])->name('admin.ticket.create');
    Route::get('/tickets-categories/edit/{id}', [TicketCategoryController::class, 'edit'])->name('admin.ticket.edit');
    Route::get('/tickets-categories/delete/{id}', [TicketCategoryController::class, 'destroy'])->name('admin.ticket.delete');
    Route::get('/tickets-categories/restore/{id}', [TicketCategoryController::class, 'restore'])->name('admin.ticket.restore');
    Route::post('/tickets-categories/store', [TicketCategoryController::class, 'store'])->name('admin.ticket.store');
    Route::patch('/tickets-categories/update/{id}', [TicketCategoryController::class, 'update'])->name('admin.ticket.update');
    Route::get('/tickets-categories/tickets/{id}', [TicketCategoryController::class, 'show'])->name('admin.category.ticket.show');
    
});