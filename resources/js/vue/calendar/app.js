import { createApp } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import CalendarApp from './CalendarApp.vue';

const app = createApp({
    components: {
        'calendar-app': CalendarApp,
        'VueDatePicker': VueDatePicker,
    },
});
app.config.globalProperties.bootstrap = bootstrap;
app.mount('#calendarApp');