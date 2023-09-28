<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketDepartment extends Model
{
    use HasFactory, Uuid;

    protected $fillable =[
        'name',
    ];

    /**
     * Get the agent associated with the TicketDepartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agent(): HasOne
    {
        return $this->hasOne(AgentDepartment::class, 'id');
    }


}
