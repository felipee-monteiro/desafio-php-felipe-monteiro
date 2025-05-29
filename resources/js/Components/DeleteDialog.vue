<template>
    <Dialog
        :title="`Excluir ${type} ?`"
        :decription="`Todos os registros com ${type} serão igualmente excluídos.`"
    >
        <template #trigger>
            <button type="button" class="text-sm text-red-600 hover:underline">
                Excluir
            </button>
        </template>

        <template #footer>
            <DialogClose as-child>
                <button
                    type="button"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow"
                >
                    Cancelar
                </button>
            </DialogClose>
            <button
                type="submit"
                form="delete.submit"
                @click="handleDelete(id)"
                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow"
            >
                Sim, Excluir
            </button>
        </template>
    </Dialog>
</template>

<script setup>
import Dialog from "@/Components/Dialog.vue";
import { DialogClose } from "@/Components/ui/dialog";

defineProps({
    type: { type: String, required: true },
    id: { type: Number, required: true },
    handleDelete: { type: Function, required: true },
});
</script>
