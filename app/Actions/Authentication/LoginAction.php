<?php

namespace App\Actions\Authentication;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginAction
{
    /**
     * Log the user in 
     * @param Array $details An array of user email and password
     * @return Array
     */
    static function run(Array $details)
    {
        if(auth()->attempt($details)){
            $role = auth()->user()->role;
            Auth::logoutOtherDevices($details['password']);
            switch ($role) {
                case 'admin':
                    return ["success" => true, "role" => "admin", "url" => redirect()->intended('/admin')];
                    break;
                case 'agent':
                    return ["success" => true, "role" => "agent", "url" => redirect()->intended('/agent')];
                    break;
                case 'user':
                    return ["success" => true, "role" => "user", "url" => redirect()->intended('/dashboard')];
                default:
                    return ["success" => true, "url" => redirect()->intended('/')];
                    break;
            }
        }else{
            return [
                "success" => false,
                "url" => ""
            ];
        }
    }
}