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
                        <VueDatePicker v-model="startDate" :max-date="finishDate" :is-24="false"
                            input-class-name="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Finish</label>
                        <VueDatePicker v-model="finishDate" :min-date="startDate" :is-24="false"
                            input-class-name="form-control" />
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Comments</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            v-model="comments"></textarea>
                    </div>
                </div>
            </template>
            <template #footer>
                <button class="btn btn-primary" @click="submitCreateEvent()" :disabled="submitBtnDisabled">
                    <span v-if="submitting">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Submitting...
                    </span>
                    <span v-else>
                        Submit
                    </span>
                </button>
            </template>
        </modal>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import axios from 'axios';
import Modal from '../components/bootstrap/Modal.vue';
import VueDatePicker from '@vuepic/vue-datepicker'; // https://vue3datepicker.com/
import '@vuepic/vue-datepicker/dist/main.css'

// TODO: validation https://vuelidate-next.netlify.app/#alternative-syntax-composition-api

const props = defineProps({
    eventTypes: Array,
});

const emit = defineEmits(['event-created']);

const submitting = ref(false);
const submitBtnDisabled = ref(false);
const eventType = ref(1);
const startDate = ref(new Date());
const finishDate = ref('');
const comments = ref('');

var createEventModal = ref(null); // template ref
function showCreateEventModal(dateDetails) {
    var startTime = new Date(dateDetails.start);
    var currentTime = new Date();
    currentTime.setHours(0,0,0,0);
    if (startTime < currentTime) {
        alert('Invalid date, please select a current or future date instead.');
        return;
    }
    if (dateDetails.allDay) {
        startTime.setHours(8); // set to 8am if clicking from month/year view
    }
    startDate.value = startTime;

    /* var finishTime = startTime;
    var startDateHours = finishTime.getHours();
    finishTime.setHours(startDateHours + 1);
    finishDate.value = finishTime; */

    createEventModal.value.show();
}

function submitCreateEvent() {
    submitting.value = true;
    const payload = {
        start_time: startDate.value,
        finish_time: finishDate.value,
        event_type_id: eventType.value,
        comments: comments.value,
    };
    axios.post('/events', payload)
        .then((response) => {
            createEventModal.value.hide();
            emit('event-created');
        })
        .catch((error) => {
            console.log(error);
        })
        .finally(() => {
            submitting.value = false;
        });
}

function resetDates() {
    startDate.value = '';
    finishDate.value = '';
}

watch(submitting, (newVal, oldVal) => {
    if (newVal == true) {
        submitBtnDisabled.value = true;
    } else {
        submitBtnDisabled.value = false;
    }
});

defineExpose({
    showCreateEventModal
});
</script>