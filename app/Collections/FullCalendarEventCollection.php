<?php

namespace App\Collections;

use App\DataTransferObjects\FullCalendarEvent;

class FullCalendarEventCollection extends TypedCollection
{
    protected string $type = FullCalendarEvent::class;

    public function highlightUserEvents(int $userId): self {
        $this->map(function ($event) use ($userId) {
            if ($event->extendedProps['user']['id'] == $userId) {
                $event->backgroundColor = '#0d6efd';
                $event->borderColor = '#0d6efd';
            }
            return $event;
        });

        return $this;
    }
}