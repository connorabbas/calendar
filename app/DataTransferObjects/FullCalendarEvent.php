<?php

namespace App\DataTransferObjects;

use DateTime;

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
        //public readonly string|null $backgroundColor = null,
        //public readonly string|null $borderColor = null,
        public readonly array $extendedProps = [],
    ) {}
}
