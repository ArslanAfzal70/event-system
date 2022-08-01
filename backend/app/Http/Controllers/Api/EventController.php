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
    public function getEventList()
    {
        return $this->eventService->getEventList();
    }

    /* ******************************************** */
    /*                 CREATE EVENT                 */
    /* ******************************************** */

    public function createEvent(EventRequest $request)
    {

        return $this->eventService->create($request);
    }

    /* ******************************************** */
    /*                  EDIT EVENT                  */
    /* ******************************************** */

    public function editEvent($id)
    {
        return $this->eventService->getEvent($id);
    }

    /* ******************************************** */
    /*                 UPDATE EVENT                 */
    /* ******************************************** */

    public function updateEvent(EventRequest $request, $id)
    {
        return $this->eventService->updateEvent($request, $id);
    }

    /* ******************************************** */
    /*                 DELETE EVENT                 */
    /* ******************************************** */

    public function deleteEvent($id)
    {
        return $this->eventService->deleteEvent($id);
    }
}
