<?php

namespace App\Transformers;

use App\DataTransferObjects\FullCalendarEvent;
use App\Models\Event;

class FullCalendarEventTransformer
{
    public static function fromEvent(Event $event): FullCalendarEvent
    {
        $event = new FullCalendarEvent(
            id: $event->id,
            start: $event->start_time,
            end: $event->finish_time,
            title: $event->user->name . ' - ' . $event->type->name,
            extendedProps: [
                'user' => $event->user,
                'event_type' => $event->type,
            ],
        );

        return $event;
    }
}
