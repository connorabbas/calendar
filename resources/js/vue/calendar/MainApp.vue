<template>
    <div>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-icons/font/bootstrap-icons.css'; // needs additional webpack config!

import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import bootstrap5Plugin from '@fullcalendar/bootstrap5'

export default {
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [bootstrap5Plugin, dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5'
            }
        }
    }
}
</script>

<style></style>