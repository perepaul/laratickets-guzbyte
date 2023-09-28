<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tickets = $user->ticket()->whereStatus('open')->paginate(20);
        return view('users.index')->with([
            "tickets" => $tickets,
            "sn" => 1
        ]);
       
    }
}
