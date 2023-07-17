<?php

namespace App\Services;

use DateTime;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use App\DataTransferObjects\FullCalendarEvent;
use App\Transformers\FullCalendarEventTransformer;

class EventService
{
    public function getEvents(): array
    {
        $calendarEvents = [];
        $events = Event::all();
        $events->load(['type', 'user']);
        foreach ($events as $event) {
            $calendarEvents[] = FullCalendarEventTransformer::fromEvent($event);
        }

        return $calendarEvents;
    }

    public function createEvent(
        DateTime $startTime,
        DateTime $finishTime,
        int $eventTypeId,
        int $userId,
        string|null $comments = null,
    ): FullCalendarEvent {
        $event = Event::create([
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'event_type_id' => $eventTypeId,
            'user_id' => $userId,
            'comments' => $comments,
        ]);
        Log::info("New Event: $event->id created for User: $event->user_id");

        return FullCalendarEventTransformer::fromEvent($event);
    }

    public function updateEvent(
        Event $event,
        DateTime $startTime,
        DateTime $finishTime,
        int $eventTypeId,
        string|null $comments = null,
    ): FullCalendarEvent {
        $event->update([
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'event_type_id' => $eventTypeId,
            'comments' => $comments,
        ]);
        Log::info("Event: $event->id updated for User: $event->user_id");

        return FullCalendarEventTransformer::fromEvent($event);
    }
}
