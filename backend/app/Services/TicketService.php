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
        $ticket = Ticket::where('id', $id)->with('event')->first();
        if ($ticket) {
            return response()->json([
                'status' => true,
                'ticket' => $ticket
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
        $ticket = Ticket::find($id);

        if (!$ticket) {
            return response()->json([
                'status' => false,
                'msg' => "something went wrong please try again"
            ]);
        }
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->phone = $request->phone;
        $ticket->type = $request->type;
        $ticket->price = $request->price;
        $ticket->event_id = $request->event_id;
        $ticket->save();

        return response()->json([
            'status' => true,
            'msg' => "Ticket Updated Successfully"
        ]);
    }

    /* ******************************************** */
    /*                 DELETE TICKET                */
    /* ******************************************** */

    public function deleteTicket($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json([
                'status' => false,
                'msg' => "something went wrong please try again"
            ]);
        }
        $ticket->delete();

        return response()->json([
            'status' => true,
            'msg' => "Ticket Deleted Successfully"
        ]);
    }
}
