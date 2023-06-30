<template>
    <div>
        <FullCalendar ref="fullCalendar" :options="calendar" />
    </div>
</template>

<script>
//import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-icons/font/bootstrap-icons.css';

import axios from 'axios';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import multiMonthPlugin from '@fullcalendar/multimonth'
import interactionPlugin from '@fullcalendar/interaction';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

/**
 * https://fullcalendar.io/docs/multimonth-grid
 * https://fullcalendar.io/blog/2023/01/multimonth-and-more
 */
export default {
    components: {
        FullCalendar
    },
    props: {
        currentUserId: Number
    },
    data() {
        return {
            events: [],
            calendar: {
                customButtons: {
                    refreshButton: {
                        text: 'Refresh',
                        click: () => {
                            this.getEvents()
                        }
                    }
                },
                headerToolbar: {
                    left: 'prev,next today refreshButton',
                    center: 'title',
                    right: 'multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay'
                },
                plugins: [
                    bootstrap5Plugin,
                    dayGridPlugin,
                    timeGridPlugin,
                    multiMonthPlugin,
                    interactionPlugin
                ],
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                droppable: false,
                editable: true,
                selectable: true,
                weekends: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                navLinks: true,
            }
        }
    },
    methods: {
        getEvents() {
            this.events = [];
            axios.get('/events') // TODO: install ziggy
                .then((response) => {
                    this.events = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        handleDateSelect(selectInfo) {
            alert('background clicked');
        },
        handleEventClick(clickInfo) {
            const eventUserId = clickInfo.event.extendedProps.user.id;
            if (eventUserId != this.currentUserId) {
                return;
            }
            alert(JSON.stringify(clickInfo));
        }
    },
    watch: {
        events: function (newVal, oldVal) {
            this.calendar.events = newVal;
        }
    },
    mounted() {
        this.getEvents();
    }
}
</script>

<style></style>