<template>
    <CrudLayout
        main-title="Gerenciamento de status dos chamados"
        not-found-message="Status não disponíveis"
        :data="status"
    >
        <template #createButton>
            <button
                type="button"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
            >
                Novo Status
            </button>
        </template>
        <template #default="{ data }">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ data.name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Criado em: {{ data.created_at }} | Atualizado em:
                        {{ data.updated_at }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <DeleteDialog
                        :handleDelete="handleDelete"
                        :type="`este status ${data.name}`"
                        :id="data.id"
                    />
                </div>
            </div>
        </template>
    </CrudLayout>
</template>

<script setup>
import CrudLayout from "@/Layouts/CrudLayout.vue";
import useForm from "@/Composables/form";
import DeleteDialog from "@/Components/DeleteDialog.vue";

defineProps({ status: { type: Array, required: true } });

const createData = useForm({
    name: "",
});

const editData = useForm({
    newName: "",
});

function handleCreate() {}
function handleEdit() {}
function handleDelete() {}
</script>
