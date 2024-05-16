<?php

use Illuminate\Support\Facades\Route;
use Yonidebleeker\Webinsights\Http\Controllers\WebinsightsController;


Route::get('webinsights', [WebinsightsController::class, 'getDashboardData']);

