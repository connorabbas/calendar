<?php

namespace App\Services;

use App\Models\Event;
use App\Transformers\FullCalendarEventTransformer;

class CalendarService
{
    public function getFullCalendarEvents()
    {
        $calendarEvents = [];
        $events = Event::all();
        $events->load(['type', 'user']);
        foreach ($events as $event) {
            $calendarEvents[] = FullCalendarEventTransformer::fromEvent($event);
        }

        return $calendarEvents;
    }

    public function getFullCalendarEvent($id)
    {
        $event = Event::with(['type', 'user'])->findOrFail($id);

        return FullCalendarEventTransformer::fromEvent($event);
    }
}
