<?php

namespace App\Services;

use DateTime;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\DataTransferObjects\FullCalendarEvent;
use App\Collections\FullCalendarEventCollection;

class EventService
{
    /**
     * Get all available Event's
     */
    public function getAllEvents(): FullCalendarEventCollection
    {
        $calendarEvents = new FullCalendarEventCollection();
        $events = Event::all();
        $events->load(['type', 'user']);
        foreach ($events as $event) {
            $calendarEvents->push(FullCalendarEvent::fromEvent($event));
        }

        return $calendarEvents;
    }

    /**
     * Get all available EventType's
     */
    public function getAllEventTypes(): Collection
    {
        return EventType::all();
    }

    /**
     * Create a new Event
     */
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

    /**
     * Update an existing Event
     */
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
     * (Soft) delete an Event model record
     */
    public function deleteEvent(Event $event): bool
    {
        return $event->delete();
    }
}
