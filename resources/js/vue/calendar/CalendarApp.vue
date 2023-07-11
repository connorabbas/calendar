<template>
    <div>
        <FullCalendar ref="fullCalendar" :options="calendarOptions" />
        <CreateEventModal ref="createEventModal" :event-types="eventTypes" @event-created="(e) => eventCreated(e)" />
        <mini-toast ref="successToast" classes="shadow text-bg-success border-0" position-classes="bottom-0 end-0 p-5"
            close-btn-classes="btn-close-white">
            <template #body>
                <i class="bi bi-check-circle-fill"></i>&nbsp; {{ successMessage }}
            </template>
        </mini-toast>
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
import MiniToast from '../components/bootstrap/MiniToast.vue';

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

// Success Toast
var successToast = ref(null); // template ref
const successMessage = ref('');
function showSuccessToast(message) {
    successMessage.value = message;
    successToast.value.show();
}

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

// Create new Event
const createEventModal = ref(null) // template ref;
function handleDateSelect(selectInfo) {
    // proxy the the child component method
    createEventModal.value.showCreateEventModal(selectInfo);
}
function eventCreated(message) {
    getEvents();
    showSuccessToast(message);
}

// TODO: Edit Event
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
.dp__action_button {
    line-height: 1rem;
}
</style>