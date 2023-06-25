<?php

namespace App\Transformers;

use App\DataTransferObjects\FullCalendarEvent;
use App\Models\Appointment;

class FullCalendarEventTransformer
{
    public static function fromAppointment(Appointment $appointment): FullCalendarEvent
    {
        $event = new FullCalendarEvent();
        $event->id = $appointment->id;
        $event->start = $appointment->start_time;
        $event->end = $appointment->finish_time;
        $event->title = $appointment->user->name . ' - ' . $appointment->type->name;
        $event->extendedProps = [
            'user' => $appointment->user,
            'appointment_type' => $appointment->type->name,
        ];

        return $event;
    }
}