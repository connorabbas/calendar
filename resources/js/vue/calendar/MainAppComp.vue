<template>
    <div>
        <FullCalendar ref="fullCalendar" :options="calendar" />
    </div>
</template>

<script setup>
import { ref, reactive, watch, onMounted } from 'vue';
import 'bootstrap-icons/font/bootstrap-icons.css';
import axios from 'axios';
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import multiMonthPlugin from '@fullcalendar/multimonth'
import interactionPlugin from '@fullcalendar/interaction';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

defineProps({
    currentUserId: Number
});
const events = ref([]);
const calendar = reactive({
    customButtons: {
        refreshButton: {
            text: 'Refresh',
            click: () => {
                getEvents()
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
    select: handleDateSelect,
    eventClick: handleEventClick,
    navLinks: true,
});

function getEvents() {
    events.value = [];
    axios.get('/events') // TODO: install ziggy
        .then((response) => {
            events.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
}
function handleDateSelect(selectInfo) {
    alert('background clicked');
}
function handleEventClick(clickInfo) {
    const eventUserId = clickInfo.event.extendedProps.user.id;
    if (eventUserId != currentUserId) {
        return;
    }
    alert(JSON.stringify(clickInfo));
}

watch(events, (newEvents) => {
    calendar.events = newEvents;
});

onMounted(() => {
    getEvents();
});
</script>