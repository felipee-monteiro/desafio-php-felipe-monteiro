<template>
    <Dialog :title="dialog.title" :decription="dialog.description">
        <template #trigger>
            <button class="text-sm text-blue-600 hover:underline">
                Editar
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
                Salvar
            </button>
        </template>
    </Dialog>
</template>

<script setup>
import Dialog from "@/Components/Dialog.vue";

defineProps({
    dialog: { type: Object, required: true },
    form: { type: String, required: true },
});
</script>
