<?php

namespace App\Services;

use App\Models\Event;
use App\DataTransferObjects\FullCalendarEvent;
use App\Transformers\FullCalendarEventTransformer;

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
}
