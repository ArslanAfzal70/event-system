<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /* ******************************************** */
    /*              GET ALL EVENTS LIST             */
    /* ******************************************** */
    public function getEvents()
    {
        return Event::all();
    }
}
