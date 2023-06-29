<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalendarService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function search(Request $request): JsonResponse
    {
        $events = $this->calendarService->getFullCalendarEvents();
        return response()->json($events);
    }

    public function get($id): JsonResponse
    {
        $event = $this->calendarService->getFullCalendarEvent($id);
        return response()->json($event);
    }
}
