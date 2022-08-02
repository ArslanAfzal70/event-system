<?php

namespace App\Services;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardService
{
    public function getDataCount()
    {
        return response()->json([
            'status' => true,
            'eventCount' => Event::get()->count(),
            'ticketCount' => Ticket::get()->count(),
            'todayBookings' => Ticket::whereDate('created_at', Carbon::today())->get()->count(),
        ]);
    }
}
