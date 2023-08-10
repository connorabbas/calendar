<?php

namespace App\Http\Controllers\Data;

use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DataTransferObjects\FullCalendarEvent;

class EventController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function search(): JsonResponse
    {
        $allEvents = $this->eventService->getAllEvents();
        return response()->json(
            $this->eventService->highlightUserEvents(
                $allEvents,
                auth()->user()->id
            )
        );
    }

    public function single(Event $event): JsonResponse
    {
        $this->authorize('view', $event);
        return response()->json(FullCalendarEvent::fromEvent($event));
    }
}
