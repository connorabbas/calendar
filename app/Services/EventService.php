<?php

namespace App\Services;

use DateTime;
use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\DataTransferObjects\FullCalendarEvent;

class EventService
{
    public function getEvents(): Collection
    {
        $calendarEvents = collect();
        $events = Event::all();
        $events->load(['type', 'user']);
        foreach ($events as $event) {
            $calendarEvents->push(FullCalendarEvent::fromEvent($event));
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

        return FullCalendarEvent::fromEvent($event);
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

        return FullCalendarEvent::fromEvent($event);
    }

    /**
     * Map a collection of FullCalendarEvent's to have the current User's Events highlighted
     *
     * @param Collection<FullCalendarEvent> $fullCalendarEvents
     * @param int $userId
     * @return array
     */
    public function highlightUserEvents(Collection $fullCalendarEvents, int $userId): Collection
    {
        $fullCalendarEvents = collect($fullCalendarEvents)->map(function ($event) use ($userId) {
            if ($event->extendedProps['user']['id'] == $userId) {
                $event->backgroundColor = '#0d6efd';
                $event->borderColor = '#0d6efd';
            }
            return $event;
        });

        return $fullCalendarEvents;
    }
}
