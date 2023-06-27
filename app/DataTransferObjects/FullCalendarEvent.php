<?php

namespace App\DataTransferObjects;

use DateTime;

/**
 * https://fullcalendar.io/docs/event-object
 */
class FullCalendarEvent
{
    // TODO: figure out required properties
    public function __construct(
        public readonly  int $id,
        public readonly DateTime $start,
        public readonly DateTime $end,
        public readonly string $title,
        public readonly bool|null $allDay = false,
        public readonly bool|null $editable = true,
        //public readonly string|null $display = null,
        //public readonly string|null $backgroundColor = null,
        //public readonly string|null $borderColor = null,
        //public readonly string|null $textColor = null,
        public readonly array|null $extendedProps = null,
    ) {
    }
}
