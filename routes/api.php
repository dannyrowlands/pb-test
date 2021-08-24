<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group( array( 'prefix' => '/v1'), function()
{
    Route::post('/appointments', [AppointmentController::class, 'createAppointment']);
    Route::get('/appointments', [AppointmentController::class, 'getAll']);
    Route::get('/appointments/{appointment_id}', [AppointmentController::class, 'getAppointment']);
    Route::put('/appointments/{appointment_id}', [AppointmentController::class, 'updateAppointment']);
    Route::delete('/appointments/{appointment_id}', [AppointmentController::class, 'deleteAppointment']);
});
