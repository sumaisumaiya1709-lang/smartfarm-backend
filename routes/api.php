<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SensorReadingController;
use App\Http\Controllers\FeedScheduleController;
use App\Http\Controllers\LampScheduleController;
use App\Http\Controllers\FeedHistoryController;
use App\Http\Controllers\LampHistoryController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\FeedRefillController;

Route::get('/devices', [DeviceController::class, 'index']);
Route::get('/sensor-readings', [SensorReadingController::class, 'index']);
Route::get('/feed-schedules', [FeedScheduleController::class, 'index']);
Route::post('/feed-schedules', [FeedScheduleController::class, 'store']);
Route::put('/feed-schedules/{id}', [FeedScheduleController::class, 'update']);
Route::delete('/feed-schedules/{id}', [FeedScheduleController::class, 'destroy']);
Route::get('/lamp-schedules', [LampScheduleController::class, 'index']);
Route::post('/lamp-schedules', [LampScheduleController::class, 'store']);
Route::put('/lamp-schedules/{id}', [LampScheduleController::class, 'update']);
Route::delete('/lamp-schedules/{id}', [LampScheduleController::class, 'destroy']);
Route::get('/feed-history', [FeedHistoryController::class, 'index']);
Route::get('/lamp-history', [LampHistoryController::class, 'index']);
Route::get('/activity-logs', [ActivityLogController::class, 'index']);
Route::post('/feed-refill', [FeedRefillController::class, 'store']);

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
