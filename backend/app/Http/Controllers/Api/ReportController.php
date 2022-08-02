<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
    public function generateReport($event_id, $ticket_id, Ticket $ticket)
    {
        return $this->reportService->generateReport($event_id, $ticket_id, $ticket);
    }
}
