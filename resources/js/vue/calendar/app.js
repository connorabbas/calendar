import { createApp } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import App from './App.vue';

const app = createApp({
    components: {
        'calendar-app': App,
        'VueDatePicker': VueDatePicker,
    },
});
app.mount('#app');