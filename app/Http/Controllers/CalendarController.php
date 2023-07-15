<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(): View
    {
        return view('pages.calendar.index', [
            'eventTypes' => EventType::all(),
            'user' => auth()->user()
        ]);
    }
}
