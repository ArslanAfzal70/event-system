<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\EventController;
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
    Route::get('get-event-list', [EventController::class, 'getEventList']);
    Route::post('create-event', [EventController::class, 'createEvent']);
    Route::get('edit-event/{id}', [EventController::class, 'editEvent']);
    Route::post('update-event/{id}', [EventController::class, 'updateEvent']);
    Route::post('delete-event/{id}', [EventController::class, 'deleteEvent']);
});
