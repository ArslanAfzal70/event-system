<?php

namespace App\Services;

use App\Http\Requests\EventRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;


class ReportService
{
    /* ******************************************** */
    /*                GENERATE REPORT               */
    /* ******************************************** */

    public function generateReport($event_id, $ticket_id, Ticket $ticket)
    {
        $ticket = $ticket->newQuery();

        if ($event_id != 'all') {
            $ticket->where('event_id', $event_id);
        }
        if ($ticket_id != 'all') {
            $ticket->where('type', $ticket_id);
        }
        return $ticket->with('event')->get();
    }
}
