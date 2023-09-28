<?php

namespace App\Actions\Authentication;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegisterAction{

    /**
     * Creates a new user
     * @param Array $arr An array of users information
     * @return Array user details
     */
    static function run(Array $arr)
    {
        $tempPassword = randomPassword(8);
        $user = User::create([
            "id" => Str::uuid(),
            "name" => $arr['name'],
            "email" => $arr['email'],
            "role" => $arr["role"] ?? 'user',
            "is_temp_password" => true,
            "password" => Hash::make($tempPassword),
        ]);
        $user["temp_password"] = $tempPassword;
        return $user;
    }
}
