<?php

namespace App\Services;

use App\Models\Event;
use App\DataTransferObjects\FullCalendarEvent;
use App\Transformers\FullCalendarEventTransformer;
use DateTime;

class CalendarService
{
    public function getFullCalendarEvents(): array
    {
        $calendarEvents = [];
        $events = Event::all();
        $events->load(['type', 'user']);
        foreach ($events as $event) {
            $calendarEvents[] = FullCalendarEventTransformer::fromEvent($event);
        }

        return $calendarEvents;
    }

    public function getFullCalendarEvent($id): FullCalendarEvent
    {
        $event = Event::with(['type', 'user'])->findOrFail($id);

        return FullCalendarEventTransformer::fromEvent($event);
    }

    public function createEvent(
        DateTime $startTime,
        DateTime $finishTime,
        int $eventTypeId,
        int $userId,
        string|null $comments = null,
    ): Event {
        return Event::create([
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'event_type_id' => $eventTypeId,
            'user_id' => $userId,
            'comments' => $comments,
        ]);
    }
}
