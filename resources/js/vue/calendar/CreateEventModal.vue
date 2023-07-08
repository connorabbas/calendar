<template>
    <div>
        <modal title="Add New Event" ref="createEventModal" :classes="['modal-dialog-centered']" @hidden="resetStartDate">
            <template #body>
                <div>
                    <div class="mb-3">
                        <VueDatePicker v-model="startDate" :is-24="false" />
                    </div>
                </div>
            </template>
            <template #footer>
                <button class="btn btn-primary">Submit</button>
            </template>
        </modal>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import axios from 'axios';
import Modal from '../components/Modal.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

var createEventModal = ref(null);
const startDate = ref(new Date());
function createEvent(dateDetails) {
    console.log(dateDetails);
    var date = new Date(dateDetails.start);
    date.setHours(8);
    startDate.value = date;
    createEventModal.value.show();
}

function resetStartDate() {
    startDate.value = new Date();
}

defineExpose({
    createEvent: createEvent,
});
</script>