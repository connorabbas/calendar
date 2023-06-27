<?php

namespace App\Transformers;

use App\DataTransferObjects\FullCalendarEvent;
use App\Models\Appointment;

class FullCalendarEventTransformer
{
    public static function fromAppointment(Appointment $appointment): FullCalendarEvent
    {
        $event = new FullCalendarEvent(
            id: $appointment->id,
            start: $appointment->start_time,
            end: $appointment->finish_time,
            title: $appointment->user->name . ' - ' . $appointment->type->name,
            extendedProps: [
                'user' => $appointment->user,
                'appointment_type' => $appointment->type,
            ],
        );

        return $event;
    }
}
