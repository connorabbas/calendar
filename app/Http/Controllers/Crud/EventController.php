<?php

namespace App\Http\Controllers\Crud;

use Carbon\Carbon;
use App\Models\Event;
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
        $validated  = $request->validated();
        $fullCalendarEvent = $this->eventService->createEvent(
            Carbon::parse($validated['start_time']),
            Carbon::parse($validated['finish_time']),
            $validated['event_type_id'],
            auth()->user()->id,
            $validated['comments'],
        );

        return response()->json([
            'message' => 'Success, your event was saved.',
            'event' => $fullCalendarEvent
        ]);
    }

    public function update(Event $event, FullCalendarEventRequest $request): JsonResponse
    {
        $this->authorize('update', $event);
        $validated  = $request->validated();
        $fullCalendarEvent = $this->eventService->updateEvent(
            $event,
            Carbon::parse($validated['start_time']),
            Carbon::parse($validated['finish_time']),
            $validated['event_type_id'],
            $validated['comments'],
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
