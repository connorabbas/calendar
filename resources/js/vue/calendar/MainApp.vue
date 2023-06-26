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
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import bootstrap5Plugin from '@fullcalendar/bootstrap5'

export default {
    components: {
        FullCalendar
    },
    props: {
        events: Array
    },
    data() {
        return {
            calendarOptions: {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                plugins: [
                    bootstrap5Plugin,
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin
                ],
                initialEvents: this.$props.events,
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventsSet: this.handleEvents
            }
        }
    },
    methods: {
        handleWeekendsToggle() {
            this.calendarOptions.weekends = !this.calendarOptions.weekends;
        },
        handleDateSelect(selectInfo) {
            alert('date clicked');
        },
        handleEventClick(clickInfo) {
            console.log(clickInfo);
            alert(JSON.stringify(clickInfo));
        },
    }
}
</script>

<style></style>