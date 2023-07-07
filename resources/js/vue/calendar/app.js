import { createApp } from 'vue';
import App from './App.vue';

const app = createApp({
    components: {
        'calendar-app': App
    },
});
app.mount('#app');