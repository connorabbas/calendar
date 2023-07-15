<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CalendarController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::view('/', 'pages.home')->name('home');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::controller(EventController::class)
        ->prefix('/events')
        ->name('events.')
        ->group(function () {
            Route::get('/', 'search')->name('search');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'get')->name('single');
            Route::patch('/{id}', 'update')->name('update');
        });
});

// TODO: admin area
// https://backpackforlaravel.com/docs/5.x/installation
// https://stackoverflow.com/questions/58753777/how-to-integrate-a-vanilla-laravel-view-into-backpack
