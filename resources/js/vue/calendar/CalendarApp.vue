<template>
    <div>
        <FullCalendar ref="fullCalendar" :options="calendarOptions" />
        <CreateEventModal ref="createEventModal" :event-types="eventTypes" @event-created="getEvents()" />
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import axios from 'axios';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import multiMonthPlugin from '@fullcalendar/multimonth'
import interactionPlugin from '@fullcalendar/interaction';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';
import CreateEventModal from './CreateEventModal.vue';

// Props
const props = defineProps({
    currentUser: Object,
    eventTypes: Array,
});

// FullCalendar Options
const calendarOptions = ref({
    headerToolbar: {
        left: 'prev,next today',
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
    select: handleDateSelect,
    eventClick: handleEventClick,
    navLinks: true,
});

// Events
const events = ref([]);
function getEvents() {
    axios.get('/events') // TODO: install ziggy
        .then((response) => {
            events.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
}

// Create new Event proxy
const createEventModal = ref(null) // template ref;
function handleDateSelect(selectInfo) {
    createEventModal.value.showCreateEventModal(selectInfo);
}

// TODO: Edit Event proxy
function handleEventClick(clickInfo) {
    const eventUserId = clickInfo.event.extendedProps.user.id;
    if (eventUserId != props.currentUser.id) {
        console.log('not yours!');
        return;
    }
    alert(JSON.stringify(clickInfo.event));
}

// Lifecycle
watch(events, (newEvents) => {
    calendarOptions.value.events = newEvents;
});
onMounted(() => {
    getEvents();
});
</script>

<style>
.fc-daygrid-event-harness:hover {
    cursor: pointer;
}
</style>