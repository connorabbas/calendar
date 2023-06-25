<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Services\CalendarService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __construct(private CalendarService $calendarService)
    {
    }

    public function index(Request $request)
    {
        $events = $this->calendarService->getCalendarEvents();
        return view('calendar.index', compact('events'));
    }
}
