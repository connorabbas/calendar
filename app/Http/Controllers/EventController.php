<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\CalendarService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FullCalendarEventRequest;

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

    public function store(FullCalendarEventRequest $request): JsonResponse
    {
        $event = $this->calendarService->createEvent(
            Carbon::parse($request->start_time),
            Carbon::parse($request->finish_time),
            $request->event_type_id,
            auth()->user()->id,
            $request->comments,
        );

        return response()->json([
            'message' => 'Success, your event was saved.',
            'event' => $event
        ]);
    }

    public function update($id, FullCalendarEventRequest $request): JsonResponse
    {
        $event = $this->calendarService->updateEvent(
            $id,
            Carbon::parse($request->start_time),
            Carbon::parse($request->finish_time),
            $request->event_type_id,
            $request->comments,
        );

        return response()->json([
            'message' => 'Success, your event has been updated.',
            'event' => $event
        ]);
    }
}
