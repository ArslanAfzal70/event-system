<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AdminController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AdminController::class, 'logout']);

    /* ******************************************** */
    /*                   DASHBOARD                  */
    /* ******************************************** */
    Route::get('get-data-count', [DashboardController::class, 'getDataCount']);

    /* ******************************************** */
    /*                    EVENTS                    */
    /* ******************************************** */
    Route::get('get-event-list', [EventController::class, 'getEventList']);
    Route::post('create-event', [EventController::class, 'createEvent']);
    Route::get('edit-event/{id}', [EventController::class, 'editEvent']);
    Route::post('update-event/{id}', [EventController::class, 'updateEvent']);
    Route::post('delete-event/{id}', [EventController::class, 'deleteEvent']);

    /* ******************************************** */
    /*                    TICKETS                   */
    /* ******************************************** */
    Route::get('get-ticket-list', [TicketController::class, 'getTicketList']);
    Route::post('create-ticket', [TicketController::class, 'createTicket']);
    Route::get('edit-ticket/{id}', [TicketController::class, 'editTicket']);
    Route::post('update-ticket/{id}', [TicketController::class, 'updateTicket']);
    Route::post('delete-ticket/{id}', [TicketController::class, 'deleteTicket']);

    /* ******************************************** */
    /*                    REPORT                    */
    /* ******************************************** */
    Route::get('generate-report/{event_id}/{ticket_id}', [ReportController::class, 'generateReport']);
});
