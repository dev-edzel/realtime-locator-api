<?php

use Illuminate\Http\Request;
use App\Http\Controllers\BusController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::prefix('bus')->group(function () {
    Route::post('update-location', [LocationController::class, 'store']);
    Route::get('latest-location/{busId}', [LocationController::class, 'show']);
});

Route::resource('buses', BusController::class);
