<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Ticket;
use App\Models\User;

class TicketInfoProvider extends ServiceProvider
{

    function ticketInfo(){
        $user = auth()->user();
        $notAssigned = 0;
        $recentTicket =[];
        if($user->role == '3'){
            $totalRecords = Ticket::where('user_id', $user->id)->count();
            $openTickets = Ticket::where('user_id', $user->id)->where('status', 0)->count();
        }elseif($user->role == '2'){
            $totalRecords = Ticket::where('agent_id', $user->id)->count();
            $openTickets = Ticket::where('agent_id', $user->id)->where('status', 0)->count();
        }else{
            $totalRecords = Ticket::count();
            $openTickets = Ticket::where('status', 0)->count();
            $notAssigned = Ticket::where('agent_id', NULL)->count();
            $recentTicket = Ticket::orderBy('created_at','DESC')->take(5)->get();
        }

        $ticketInfo = [
            'totalRecords' => $totalRecords,
            'openTickets' => $openTickets,
            'notAssigned' => $notAssigned,
            'recentTicket' => $recentTicket,
        ];
        return ($ticketInfo);
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['dashboard','ticket.index'], function($views){
            $views->with('ticketInfo', function(){
                return $this->ticketInfo();
            });
         });
    }
}
