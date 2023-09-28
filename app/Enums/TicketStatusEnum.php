<?php

namespace App\Enums;

enum TicketStatusEnum:string {
    case Open = 'open';
    case Pending = 'pending';
    case Solved = 'solved';
    case Closed = 'closed';
    case Onhold = 'on-hold';
}