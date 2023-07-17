<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::view('/', 'pages.home')->name('home');
    Route::controller(EventController::class)
        ->prefix('/events')
        ->name('events.')
        ->group(function () {
            Route::get('/', 'index')->name('calendar');
            Route::post('/', 'store')->name('store');
            Route::patch('/{id}', 'update')->name('update');
            Route::get('/search', 'search')->name('search');
            Route::get('/{id}', 'get')->name('single');
        });
});

// TODO: admin area
// https://backpackforlaravel.com/docs/5.x/installation
// https://stackoverflow.com/questions/58753777/how-to-integrate-a-vanilla-laravel-view-into-backpack
