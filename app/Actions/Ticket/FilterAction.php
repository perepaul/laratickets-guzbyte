<?php

namespace App\Actions\Ticket;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class FilterAction {

    /**
     * Filter tickets
     * @param Array $dateArr  The range of date to filter from.
     * @param Builder $tickets The query builder of tickets
     * @param int $ticket_id The ID of the ticket
     * @param string $status The status of the Ticket to filter
     * @return Builder
     */
    static function run($dateArr=null,  $tickets, $ticket_id=null, $status)
    {
        if(!is_null($dateArr)){
            if(count($dateArr) == 1){
                $tickets->whereDate('created_at', date('Y-m-d', strtotime($dateArr[0])));
            }else{
                $from = Carbon::parse(date('d-m-Y', strtotime($dateArr[0])))->startOfDay();
                $to = Carbon::parse(date('d-m-Y', strtotime($dateArr[1])))->endOfDay();
                $tickets->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to);
            }
        }
        if(!is_null($status)){
            if(!empty($status)){
                $tickets->whereStatus($status);
            }
        }

        if(!is_null($ticket_id)){
            if(!empty($ticket_id)){
                $tickets->whereTrackingId($ticket_id);
            }
        }
        
        return $tickets;
    }

}