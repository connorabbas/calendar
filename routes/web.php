<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::controller(EventController::class)
        ->prefix('/events')
        ->name('events.')
        ->group(function () {
            Route::get('/', 'search')->name('search');
            Route::get('/{id}', 'get')->name('single');
        });
});
