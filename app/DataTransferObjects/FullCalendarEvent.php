<?php

namespace App\DataTransferObjects;

use DateTime;
use App\Models\Event;

/**
 * https://fullcalendar.io/docs/event-object
 * TODO: figure out other required properties
 */
class FullCalendarEvent
{
    public function __construct(
        public readonly int $id,
        public readonly DateTime $start,
        public readonly DateTime $end,
        public readonly string $title,
        public readonly bool $allDay = false,
        public readonly bool $editable = true,
        public readonly bool $startEditable = false,
        public readonly bool $durationEditable = false,
        public string|null $backgroundColor = '#6c757d',
        public string|null $borderColor = '#6c757d',
        public readonly array $extendedProps = [],
    ) {
    }

    public static function fromEvent(Event $event): FullCalendarEvent
    {
        $event = new self(
            id: $event->id,
            start: $event->start_time,
            end: $event->finish_time,
            title: $event->user->name . ' - ' . $event->type->name,
            extendedProps: [
                'comments' => $event->comments,
                'user' => $event->user,
                'event_type' => $event->type,
            ],
        );

        return $event;
    }
}
