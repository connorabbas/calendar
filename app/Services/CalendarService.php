<?php

namespace App\Services;

use DateTime;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use App\Exceptions\PermissionDeniedException;
use App\DataTransferObjects\FullCalendarEvent;
use App\Transformers\FullCalendarEventTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CalendarService
{
    public function getEvents(): array
    {
        $calendarEvents = [];
        $events = Event::all();
        $events->load(['type', 'user']);
        foreach ($events as $event) {
            $calendarEvents[] = FullCalendarEventTransformer::fromEvent($event);
        }

        return $calendarEvents;
    }

    public function getEvent($id, User $user): FullCalendarEvent
    {
        $event = Event::with(['type', 'user'])->find($id);
        if (!$event) {
            throw new ModelNotFoundException();
        }
        if ($user->cannot('view', $event)) {
            throw new PermissionDeniedException();
        }

        return FullCalendarEventTransformer::fromEvent($event);
    }

    public function createEvent(
        DateTime $startTime,
        DateTime $finishTime,
        int $eventTypeId,
        int $userId,
        string|null $comments = null,
    ): FullCalendarEvent {
        $event = Event::create([
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'event_type_id' => $eventTypeId,
            'user_id' => $userId,
            'comments' => $comments,
        ]);
        Log::info("New Event: $event->id created for User: $event->user_id");

        return FullCalendarEventTransformer::fromEvent($event);
    }

    public function updateEvent(
        int $id,
        DateTime $startTime,
        DateTime $finishTime,
        int $eventTypeId,
        string|null $comments = null,
        User $user
    ): FullCalendarEvent {
        $event = Event::with(['type', 'user'])->find($id);
        if (!$event) {
            throw new ModelNotFoundException();
        }
        if ($user->cannot('update', $event)) {
            throw new PermissionDeniedException();
        }
        $event->update([
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'event_type_id' => $eventTypeId,
            'comments' => $comments,
        ]);
        Log::info("Event: $event->id updated for User: $event->user_id");

        return FullCalendarEventTransformer::fromEvent($event);
    }
}
