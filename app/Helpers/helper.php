<?php

use App\Models\Ticket;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

if(!function_exists('randomPassword')){
    /**
     * Generates a random alphanumeric password
     * @param int $len The length of the password
     * @return string random password
     */
    function randomPassword($len) { 
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, $len); 
    } 
}

if(!function_exists('roleUrl')){
    /**
     * Get the redirect to url base on roles
     * @param string $role The user role
     * @return string user dashboard url
     */
    function roleUrl($role) { 
        switch ($role) {
            case 'admin':
              return '/admin';
              break;
            case 'agent':
              return '/agent';
              break; 
            default:
              return'/dashboard';
            break;
          }
    } 
}

if (!function_exists('generateTicketId')){
  function generateTicketId(){
      return  substr(str_shuffle(time() . rand(10*45, 100*98)), 0, 7);
  }
}

/**
 * Get Ticket By ticket Id
 * @param String $is The Id of the Ticket
 * @return  App\Models\User
 */
if (!function_exists('getTicketById')){
  function getTicketById($id){
      return  Ticket::findOrFail($id);
  }
}

if(!function_exists('custompaginate')){
  function custompaginate($items, $perPage = 20, $page = null, $options = [])
  {
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator($items->forPage($page, $perPage)->values(), $items->count(), $perPage, $page, $options);
  }
}

