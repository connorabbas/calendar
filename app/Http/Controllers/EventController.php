<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\View\View;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FullCalendarEventRequest;
use App\Transformers\FullCalendarEventTransformer;

class EventController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function index(): View
    {
        return view('pages.events.calendar', [
            'eventTypes' => EventType::all(),
            'user' => auth()->user()
        ]);
    }

    public function search(): JsonResponse
    {
        $fullCalendarEvents = $this->eventService->getEvents();
        return response()->json($fullCalendarEvents);
    }

    public function get(int $id): JsonResponse
    {
        $event = Event::with(['type', 'user'])->findOrFail($id);
        $this->authorize('view', $event);

        return response()->json(FullCalendarEventTransformer::fromEvent($event));
    }

    public function store(FullCalendarEventRequest $request): JsonResponse
    {
        $fullCalendarEvent = $this->eventService->createEvent(
            Carbon::parse($request->start_time),
            Carbon::parse($request->finish_time),
            $request->event_type_id,
            auth()->user()->id,
            $request->comments,
        );

        return response()->json([
            'message' => 'Success, your event was saved.',
            'event' => $fullCalendarEvent
        ]);
    }

    public function update(int $id, FullCalendarEventRequest $request): JsonResponse
    {
        $event = Event::with(['type', 'user'])->findOrFail($id);
        $this->authorize('update', $event);
        $fullCalendarEvent = $this->eventService->updateEvent(
            $event,
            Carbon::parse($request->start_time),
            Carbon::parse($request->finish_time),
            $request->event_type_id,
            $request->comments,
            auth()->user()
        );

        return response()->json([
            'message' => 'Success, your event has been updated.',
            'event' => $fullCalendarEvent
        ]);
    }
}
