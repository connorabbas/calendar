<template>
    <div class="toast-container position-fixed" :class="positionClasses">
        <div class="toast" :class="classes" role="alert" aria-live="assertive" aria-atomic="true" :data-bs-delay="timeout"
            ref="toastRef">
            <div class="toast-header">
                <slot name="header"></slot>
                <button type="button" class="btn-close" :class="closeBtnClasses" aria-label="Close" @click="hide()"></button>
            </div>
            <div class="toast-body">
                <slot name="body"></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
    classes: String,
    positionClasses: String, // https://getbootstrap.com/docs/5.2/components/toasts/#placement
    closeBtnClasses: String,
    timeout: {
        type: [Number, String],
        default: 3000,
    }
});

const emit = defineEmits(['shown', 'hidden']);

const shown = ref(false);
const hidden = ref(true);

var toastRef = ref(null) // template ref;
var toastObj = null;

function show() {
    emit('shown');
    shown.value = true;
    hidden.value = false;
    toastObj.show();
}
function hide() {
    emit('hidden');
    shown.value = false;
    hidden.value = true;
    toastObj.hide();
}

defineExpose({
    shown,
    hidden,
    show,
    hide,
});

onMounted(() => {
    toastObj = new bootstrap.Toast(toastRef.value);
});
</script>