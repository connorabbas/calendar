<?php

namespace App\Services;

use App\Models\Appointment;
use App\Transformers\FullCalendarEventTransformer;

class CalendarService
{
    public function getCalendarEvents()
    {
        $events = [];
        //$appointments = Appointment::with('type', 'user')->get(); // behaving weirdly, eager load lazily instead
        $appointments = Appointment::all();
        $appointments->load(['type', 'user']);
        foreach ($appointments as $appointment) {
            $events[] = FullCalendarEventTransformer::fromAppointment($appointment);
        }

        return $events;
    }
}
