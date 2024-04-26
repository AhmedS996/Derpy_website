<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/events', [EventController::class, 'index']);
Route::get('/groups', [GroupController::class, 'index']);
Route::get('/users', [AppController::class, 'index']);

