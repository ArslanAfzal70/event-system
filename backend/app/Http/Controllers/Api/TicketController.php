<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;

class TicketController extends Controller
{

    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /* ******************************************** */
    /*                GET TICKET LIST               */
    /* ******************************************** */
    public function getTicketList()
    {
        return $this->ticketService->getTicketList();
    }

    /* ******************************************** */
    /*                 CREATE TICKET                */
    /* ******************************************** */

    public function createTicket(TicketRequest $request)
    {

        return $this->ticketService->create($request);
    }

    /* ******************************************** */
    /*                  EDIT TICKET                 */
    /* ******************************************** */

    public function editTicket($id)
    {
        return $this->ticketService->getTicket($id);
    }

    /* ******************************************** */
    /*                 UPDATE TICKET                */
    /* ******************************************** */

    public function updateTicket(TicketRequest $request, $id)
    {
        return $this->ticketService->updateTicket($request, $id);
    }

    /* ******************************************** */
    /*                 DELETE TICKET                */
    /* ******************************************** */

    public function deleteTicket($id)
    {
        return $this->ticketService->deleteTicket($id);
    }
}
