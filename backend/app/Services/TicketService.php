<?php

namespace App\Services;

use App\Http\Requests\EventRequest;
use App\Http\Requests\TicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;


class TicketService
{

    /* ******************************************** */
    /*                 CREATE TICKET                */
    /* ******************************************** */

    public function create(TicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->phone = $request->phone;
        $ticket->type = $request->type;
        $ticket->price = $request->price;
        $ticket->event_id = $request->event_id;
        $ticket->save();

        return response()->json([
            'status' => true,
            'msg' => "Ticket Created Successfully"
        ]);
    }

    /* ******************************************** */
    /*                GET TICKET LIST               */
    /* ******************************************** */

    public function getTicketList()
    {
        return Ticket::with('event')->get();
    }

    /* ******************************************** */
    /*                  GET TICKET                  */
    /* ******************************************** */
    public function getTicket($id)
    {
        $event = Event::find($id);
        if ($event) {
            return response()->json([
                'status' => true,
                'event' => $event
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    /* ******************************************** */
    /*                 UPDATE TICKET                */
    /* ******************************************** */

    public function updateTicket(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json([
                'status' => false,
                'msg' => "something went wrong please try again"
            ]);
        }
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date_start = $request->date_start;
        $event->date_end = $request->date_end;
        $event->silver_price = $request->silver_price;
        $event->gold_price = $request->gold_price;
        $event->platinum_price = $request->platinum_price;
        $event->capacity = $request->capacity;
        $event->save();

        return response()->json([
            'status' => true,
            'msg' => "Event Updated Successfully"
        ]);
    }

    /* ******************************************** */
    /*                 DELETE TICKET                */
    /* ******************************************** */

    public function deleteTicket($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'status' => false,
                'msg' => "something went wrong please try again"
            ]);
        }
        $event->delete();

        return response()->json([
            'status' => true,
            'msg' => "Event Deleted Successfully"
        ]);
    }
}
