<?php

use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// TODO: add auth middleware
Route::controller(CalendarController::class)->group(function () {
    Route::get('/calendar', 'index');
});
