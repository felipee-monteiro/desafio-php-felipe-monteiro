<template>
    <Dialog :title="dialog.title" :decription="dialog.description">
        <template #trigger>
            <button
                type="button"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
            >
                {{ buttonTitle }}
            </button>
        </template>
        <template #default>
            <slot />
        </template>
        <template #footer>
            <button
                type="submit"
                :form="form"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
            >
                Criar
            </button>
        </template>
    </Dialog>
</template>
<script setup>
import Dialog from "@/Components/Dialog.vue";

defineProps({
    buttonTitle: { type: String, required: true },
    dialog: { type: Object, required: true },
    form: { type: String, required: true },
});
</script>
