<?php

namespace App\DataTransferObjects;

use DateTime;
use Carbon\Carbon;
use App\Models\Event;
use App\Http\Requests\FullCalendarEventRequest;

/**
 * https://fullcalendar.io/docs/event-object
 */
class FullCalendarEvent
{
    public function __construct(
        public readonly ?int $id,
        public readonly DateTime $start,
        public readonly DateTime $end,
        public readonly string $title = 'Calendar Event',
        public readonly bool $allDay = false,
        public readonly bool $editable = true,
        public readonly bool $startEditable = false,
        public readonly bool $durationEditable = false,
        public string|null $backgroundColor = '#6c757d',
        public string|null $borderColor = '#6c757d',
        public readonly ?array $extendedProps = [],
    ) {
    }

    public static function fromEvent(Event $event): self
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

    public static function fromRequest(FullCalendarEventRequest $request): self
    {
        $event = new self(
            id: null,
            start: Carbon::parse($request->start_time),
            end: Carbon::parse($request->finish_time),
            extendedProps: [
                'comments' => $request->comments,
                'user' => $request->user(),
                'event_type_id' => $request->event_type_id,
            ],
        );

        return $event;
    }
}
