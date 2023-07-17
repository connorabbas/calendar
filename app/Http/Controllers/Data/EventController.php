<?php

namespace App\Http\Controllers\Data;

use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Transformers\FullCalendarEventTransformer;

class EventController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

    public function search(): JsonResponse
    {
        return response()->json(
            $this->eventService->highlightUserEvents($this->eventService->getEvents(), auth()->user()->id)
        );
    }

    public function single(int $id): JsonResponse
    {
        $event = Event::with(['type', 'user'])->findOrFail($id);
        $this->authorize('view', $event);

        return response()->json(FullCalendarEventTransformer::fromEvent($event));
    }
}
