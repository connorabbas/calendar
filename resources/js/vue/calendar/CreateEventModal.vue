<template>
    <div>
        <modal title="Schedule New Event" ref="createEventModal" :classes="['modal-dialog-centered']"
            :footer-close-btn="false" @hidden="resetDates">
            <template #body>
                <div>
                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <select class="form-select" aria-label="Default select example" v-model="eventType">
                            <option v-for="eventType in eventTypes" :key="eventType.id" :value="eventType.id">
                                {{ eventType.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start</label>
                        <VueDatePicker v-model="startDate" :max-date="finishDate" :is-24="false" minutes-increment="15" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Finish</label>
                        <VueDatePicker v-model="finishDate" :min-date="startDate" :is-24="false" minutes-increment="15" />
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Comments</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            v-model="comments"></textarea>
                    </div>
                </div>
            </template>
            <template #footer>
                <button class="btn btn-primary" @click="submitCreateEvent()">Submit</button>
            </template>
        </modal>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import Modal from '../components/bootstrap/Modal.vue';
import VueDatePicker from '@vuepic/vue-datepicker'; // https://vue3datepicker.com/
import '@vuepic/vue-datepicker/dist/main.css'

// TODO: validation https://vuelidate-next.netlify.app/#alternative-syntax-composition-api

const props = defineProps({
    eventTypes: Array,
});

const eventType = ref(1);
const startDate = ref(new Date());
const finishDate = ref('');
const comments = ref('');

var createEventModal = ref(null); // template ref
function showCreateEventModal(dateDetails) {
    var date = new Date(dateDetails.start);
    date.setHours(8);
    startDate.value = date;
    createEventModal.value.show();
}

function submitCreateEvent() {
    const payload = {
        start_time: startDate.value,
        finish_time: finishDate.value,
        event_type_id: eventType.value,
        comments: comments.value,
    };
    axios.post('/events', payload)
        .then((response) => {
            createEventModal.value.hide();
        })
        .catch((error) => {
            console.log(error);
        });
}

function resetDates() {
    startDate.value = new Date();
    finishDate.value = '';
}

defineExpose({
    showCreateEventModal
});
</script>