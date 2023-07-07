<template>
    <div>
        <div class="modal fade" tabindex="-1" ref="modalRef">
            <div class="modal-dialog" :class="classes">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <slot name="body" />
                    </div>
                    <div class="modal-footer">
                        <slot name="footer" />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { Modal } from "bootstrap";

const props = defineProps({
    title: {
        type: String,
        default: "<<Title goes here>>",
    },
    classes: Array
});

var modalRef = ref(null);
var modalObj = null;

function showModal() {
    modalObj.show();
}
function hideModal() {
    modalObj.hide();
}

defineExpose({
    show: showModal,
    hide: hideModal,
});

onMounted(() => {
    modalObj = new Modal(modalRef.value);
});
</script>