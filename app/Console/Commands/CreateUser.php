<?php

namespace App\Console\Commands;

use App\Actions\Authentication\RegisterAction;
use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user
    {name : The name of the user}
    {email : The email of the user}
    {role? : The user role can either be admin, user or agent}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an new admin user with a temporary password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        if(!User::whereEmail($email)->exists()){
            $user = RegisterAction::run([
                "name" => $this->argument('name'),
                "email" => $this->argument('email'),
                "role" => $this->argument('role') ?? 'user'
            ]);
            echo json_encode($user);
        } else {
            echo $this->argument('email'). " Already Exists";
        }
        

        
    }
}
