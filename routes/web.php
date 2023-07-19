<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crud\EventController as EventCrudController;
use App\Http\Controllers\Data\EventController as EventDataController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::view('/', 'pages.home')->name('home');

    // index view and crud actions related to Events
    Route::prefix('/events')
        ->name('events.')
        ->controller(EventCrudController::class)
        ->group(function () {
            Route::get('/', 'index')->name('calendar');
            Route::post('/', 'store')->name('store');
            Route::patch('/{event}', 'update')->name('update');
        });

    // Restful data endpoints
    Route::prefix('/data')
        ->name('data.')
        ->group(function () {
            Route::prefix('/events')
                ->name('events.')
                ->controller(EventDataController::class)
                ->group(function () {
                    Route::get('/search', 'search')->name('search');
                    Route::get('/{event}', 'single')->name('single');
                });
        });
});

// TODO: admin area
// https://backpackforlaravel.com/docs/5.x/installation
// https://stackoverflow.com/questions/58753777/how-to-integrate-a-vanilla-laravel-view-into-backpack
