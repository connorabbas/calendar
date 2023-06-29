<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalendarService;

class EventController extends Controller
{
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function all()
    {
        $events = $this->calendarService->getFullCalendarEvents();
        return response()->json($events);
    }

    public function get($id)
    {
        $event = $this->calendarService->getFullCalendarEvent($id);
        return response()->json($event);
    }
}
