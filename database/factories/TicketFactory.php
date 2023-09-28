<?php

namespace Database\Factories;

use App\Models\TicketDepartment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id');
        $departments = TicketDepartment::pluck('id');
        return [
            'tracking_id' => generateTicketId(),
            'user_id' => fake()->randomElement($userIds),
            'ticket_department_id' => fake()->randomElement($departments),
            'subject' => fake()->sentence(),
            'body' => fake()->text()
        ];
    }
}
