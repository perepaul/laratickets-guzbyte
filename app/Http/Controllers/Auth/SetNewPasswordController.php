<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class SetNewPasswordController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function index()
    {
        return view('auth.setpassword');
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => ["required",
                Password::min(8)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised(),
            'confirmed'],
        ]);
        $validator->validate();
        auth()->user()->update([
            "password" => Hash::make($request->password),
            "is_temp_password" => false
        ]);
        return redirect()->route('home');
    }
}
