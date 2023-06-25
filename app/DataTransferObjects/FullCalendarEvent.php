<?php

namespace App\DataTransferObjects;

use DateTime;

/**
 * https://fullcalendar.io/docs/event-object
 */
class FullCalendarEvent
{
    public int $id;
    public bool $allDay = false;
    public DateTime $start;
    public DateTime $end;
    public string $title;
    public bool $editable = true;
    public string $display;
    public string $backgroundColor;
    public string $borderColor;
    public string $textColor;
    public array $extendedProps;
}