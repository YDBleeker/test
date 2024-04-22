<?php

use Illuminate\Support\Facades\Route;
use Yonidebleeker\Webinsights\Http\Controllers\WebinsightsController;

//Route::middleware(['auth'])->group(function () {
    Route::get('webinsights', [WebinsightsController::class, 'getDashboardData']);
//});
Route::get('webinsights/test', [WebinsightsController::class, 'test']);
