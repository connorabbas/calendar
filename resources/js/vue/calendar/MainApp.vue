<template>
    <div>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-icons/font/bootstrap-icons.css'; // needs additional webpack config!

import axios from 'axios';
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import bootstrap5Plugin from '@fullcalendar/bootstrap5'

/**
 * https://fullcalendar.io/docs/multimonth-grid
 * https://fullcalendar.io/blog/2023/01/multimonth-and-more
 */
export default {
    components: {
        FullCalendar
    },
    data() {
        return {
            eventsData: [],
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
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                editable: false,
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
        getInitialEvents() {
            axios.get('/events') // TODO: install ziggy
                .then((response) => {
                    this.calendarOptions.events = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleDateSelect(selectInfo) {
            alert('date clicked');
        },
        handleEventClick(clickInfo) {
            console.log(clickInfo);
            alert(JSON.stringify(clickInfo));
        },
    },
    mounted() {
        this.getInitialEvents();
    }
}
</script>

<style></style>