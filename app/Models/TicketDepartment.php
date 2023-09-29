<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketDepartment extends Model
{
    use HasFactory, Uuid;

    protected $fillable =[
        'name',
        'is_deleted',
        'deleted_at'
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

    /**
     * Get the ticket associated with the TicketDepartment
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class, 'ticket_department_id');
    }


}
