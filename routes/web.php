<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::controller(EventController::class)
        ->prefix('/events')
        ->name('events.')
        ->group(function () {
            Route::get('/', 'search')->name('search');
            Route::get('/{id}', 'get')->name('single');
            Route::post('/', 'store')->name('store');
        });
});

// TODO: admin area
// https://backpackforlaravel.com/docs/5.x/installation
// https://stackoverflow.com/questions/58753777/how-to-integrate-a-vanilla-laravel-view-into-backpack
