<?php

use Illuminate\Support\Facades\Route;
use Yonidebleeker\Webinsights\Http\Controllers\WebinsightsController;

Route::get('webinsights', [WebinsightsController::class, 'index']);

Route::get('hello', function () {
    return 'Hello World';
});

//ok