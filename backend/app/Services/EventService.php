<?php

namespace App\Services;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;


class EventService
{

    /* ******************************************** */
    /*                 CREATE EVENT                 */
    /* ******************************************** */
    public function create(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date_start = $request->date_start;
        $event->date_end = $request->date_end;
        $event->silver_price = $request->silver_price;
        $event->gold_price = $request->gold_price;
        $event->platinum_price = $request->platinum_price;
        $event->capacity = $request->capacity;
        $event->save();
    }

    /* ******************************************** */
    /*                GET EVENT LIST                */
    /* ******************************************** */

    public function getEventList()
    {
        return Event::all();
    }

    /* ******************************************** */
    /*                   GET EVENT                  */
    /* ******************************************** */
    public function getEvent($id)
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
}
