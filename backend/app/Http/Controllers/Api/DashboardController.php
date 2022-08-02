<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /* ******************************************** */
    /*                GET DATA COUNT                */
    /* ******************************************** */

    public function getDataCount()
    {

        return $this->dashboardService->getDataCount();
    }
}
