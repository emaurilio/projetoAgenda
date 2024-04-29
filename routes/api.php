<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\EventsController as ApiEventController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/events/{user_id}', [ApiEventController::class,'index']);

Route::delete('/events/delete/{id}',[ApiEventController::class,'destroy']);
