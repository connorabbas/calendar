<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\CalendarService;
use Illuminate\Http\JsonResponse;
use App\Exceptions\PermissionDeniedException;
use App\Http\Requests\FullCalendarEventRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function search(Request $request): JsonResponse
    {
        $events = $this->calendarService->getEvents();
        return response()->json($events);
    }

    public function get(int $id): JsonResponse
    {
        try {
            $event = $this->calendarService->getEvent($id, auth()->user());
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        } catch (PermissionDeniedException $e) {
            abort(403, $e->getMessage());
        }

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

    public function update(int $id, FullCalendarEventRequest $request): JsonResponse
    {
        try {
            $event = $this->calendarService->updateEvent(
                $id,
                Carbon::parse($request->start_time),
                Carbon::parse($request->finish_time),
                $request->event_type_id,
                $request->comments,
                auth()->user()
            );
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        } catch (PermissionDeniedException $e) {
            abort(403, $e->getMessage());
        }

        return response()->json([
            'message' => 'Success, your event has been updated.',
            'event' => $event
        ]);
    }
}
