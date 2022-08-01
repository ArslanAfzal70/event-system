<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{

    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /* ******************************************** */
    /*              GET ALL EVENTS LIST             */
    /* ******************************************** */
    public function getEvents()
    {
        return Event::all();
    }

    /* ******************************************** */
    /*                 CREATE EVENT                 */
    /* ******************************************** */

    public function createEvent(EventRequest $request)
    {

        $this->eventService->create($request);
        return response()->json([
            'status' => true,
            'msg' => "Event Added Successfully"
        ]);
    }
}
