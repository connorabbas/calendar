<template>
    <div>
        <modal title="Add New Event" ref="createEventModal" :classes="['modal-dialog-centered']" :footer-close-btn="false" 
            @hidden="resetStartDate">
            <template #body>
                <div>
                    <div class="mb-3">
                        <label class="form-label">Start</label>
                        <VueDatePicker v-model="startDate" :is-24="false" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Finish</label>
                        <VueDatePicker v-model="finishDate" :is-24="false" />
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
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const startDate = ref(new Date());
const finishDate = ref(new Date());

var createEventModal = ref(null);
function showCreateEventModal(dateDetails) {
    // TODO: validate date isn't older than current
    var date = new Date(dateDetails.start);
    date.setHours(8);
    startDate.value = date;
    createEventModal.value.show();
}

function submitCreateEvent() {
    console.log('submit');
}

function resetStartDate() {
    startDate.value = new Date();
}

defineExpose({
    showCreateEventModal
});
</script>