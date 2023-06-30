import { createApp } from 'vue';
import MainApp from './MainApp.vue';
import MainAppComp from './MainAppComp.vue';

const app = createApp({
    components: {
        'main-app': MainAppComp
    },
});
app.mount('#app');