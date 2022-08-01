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

        return response()->json([
            'status' => true,
            'msg' => "Event Added Successfully"
        ]);
    }

    /* ******************************************** */
    /*                GET EVENT LIST                */
    /* ******************************************** */

    public function getEventList()
    {
        return Event::withCount('tickets')->get();
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

    /* ******************************************** */
    /*                 UPDATE EVENT                 */
    /* ******************************************** */

    public function updateEvent(Request $request, $id)
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
    /*                 DELETE EVENT                 */
    /* ******************************************** */

    public function deleteEvent($id)
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
