<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalendarService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreEventRequest;

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

    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = $this->calendarService->createEvent(
            $request->start_time,
            $request->finish_time,
            $request->event_type_id,
            $request->user()->id,
            $request->comments,
        );

        return response()->json([
            'message' => 'Success, your event was saved.',
            'event' => $event
        ]);
    }
}
