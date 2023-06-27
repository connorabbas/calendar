<?php

namespace App\Services;

use App\Models\Event;
use App\Transformers\FullCalendarEventTransformer;

class CalendarService
{
    public function getCalendarEvents()
    {
        $events = [];
        //$events = Event::with('type', 'user')->get(); // behaving weirdly, eager load lazily instead
        $events = Event::all();
        $events->load(['type', 'user']);
        foreach ($events as $event) {
            $events[] = FullCalendarEventTransformer::fromEvent($event);
        }

        return $events;
    }
}
