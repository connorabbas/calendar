<template>
    <div>
        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" ref="modalRef">
            <div class="modal-dialog" :class="classes">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ title }}</h5>
                        <button type="button" class="btn-close" aria-label="Close" @click="hide()"></button>
                    </div>
                    <div class="modal-body">
                        <slot name="body" />
                    </div>
                    <div class="modal-footer">
                        <slot name="footer" />
                        <button v-if="footerCloseBtn" type="button" class="btn btn-secondary" @click="hide()">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref, reactive } from "vue";
import { Modal } from "bootstrap";

const props = defineProps({
    title: {
        type: String,
        default: "<<Title goes here>>",
    },
    footerCloseBtn: {
        type: Boolean,
        default: true,
    },
    classes: Array
});

const emit = defineEmits(['shown', 'hidden']);

const shown = ref(false);
const hidden = ref(true);

var modalRef = ref(null);
var modalObj = null;

function show() {
    emit('shown');
    shown.value = true;
    hidden.value = false;
    modalObj.show();
}
function hide() {
    emit('hidden');
    shown.value = false;
    hidden.value = true;
    modalObj.hide();
}

defineExpose({
    shown,
    hidden,
    show,
    hide,
});

onMounted(() => {
    modalObj = new Modal(modalRef.value);
});
</script>