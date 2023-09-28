<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'tracking_id',
        'user_id',
        'ticket_department_id',
        'subject',
        'body',
        'status',
        "attachment"
    ];

    protected $casts = [
        'tracking_id' => 'integer',
        'status' => TicketStatusEnum::class
    ];

    /**
     * Get the user that owns the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the replies for the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class);
    }

    public function scopeOpenTicket($query){
        return $query->where('status', 'open');
    }

    public function scopeClosedTicket($query){
        return $query->where('status', 'closed');
    }

    public function scopeSolvedTicket($query){
        return $query->where('status', 'solved');
    }

    public function scopeOnHoldTicket($query){
        return $query->where('status', 'on-hold');
    }
}
