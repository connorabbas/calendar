<?php

namespace App\Http\Controllers\Crud;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\View\View;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\FullCalendarEventRequest;

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
            'eventTypes' => $this->eventService->getAllEventTypes(),
            'user' => auth()->user()
        ]);
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

    public function update(Event $event, FullCalendarEventRequest $request): JsonResponse
    {
        $this->authorize('update', $event);
        $fullCalendarEvent = $this->eventService->updateEvent(
            $event,
            Carbon::parse($request->start_time),
            Carbon::parse($request->finish_time),
            $request->event_type_id,
            $request->comments,
        );

        return response()->json([
            'message' => 'Success, your event has been updated.',
            'event' => $fullCalendarEvent
        ]);
    }

    public function destroy(Event $event): JsonResponse
    {
        $this->authorize('delete', $event);
        $this->eventService->deleteEvent($event);

        return response()->json([
            'message' => 'Success, your event has been cancelled.',
        ]);
    }
}
