import { createApp } from 'vue';
import MainApp from './MainApp.vue';

const app = createApp({
    components: {
        'main-app': MainApp
    },
});
app.mount('#app');