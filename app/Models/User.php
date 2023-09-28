<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_temp_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get all of the department for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function department(): HasOne
    {
        return $this->hasOne(AgentDepartment::class);
    }

    public function scopeAgents($query)
    {
        return $query->whereRole('agent');
    }

    /**
     * Get all of the ticket for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticket(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get all of the replies for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class);
    }
}
