<template>
    <CrudLayout
        main-title="Gerenciamento de status dos chamados"
        not-found-message="Status não disponíveis"
        :data="status"
    >
        <template #createButton>
            <DialogCreate
                button-title="Novo Status"
                form="create.submit"
                :dialog="{
                    title: 'Criar Status',
                    description: 'Crie um status para classificar os chamados',
                }"
            >
                <div class="my-2">
                    <form
                        id="create.submit"
                        @submit.prevent="handleCreate(data)"
                    >
                        <Label for="status_name">Nome</Label>
                        <Input v-model="createData.name" id="status_name" />
                    </form>
                </div>
            </DialogCreate>
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
                    <DialogEdit
                        :dialog="{
                            title: 'Editar status - ' + data.name,
                            description:
                                'Edite o status de acordo com os campos abaixo',
                        }"
                        form="update.submit"
                    >
                        <div class="my-2">
                            <form
                                id="update.submit"
                                @submit.prevent="handleEdit(data)"
                            >
                                <Label for="status_edit_name">Nome</Label>
                                <Input
                                    v-model="createData.name"
                                    id="status_edit_name"
                                />
                            </form>
                        </div>
                    </DialogEdit>

                    <DeleteDialog
                        :handleDelete="handleDelete"
                        :type="`o status
                    ${data.name}`"
                        :id="data.id"
                    />
                </div>
            </div>
        </template>
    </CrudLayout>
</template>

<script setup>
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import CrudLayout from "@/Layouts/CrudLayout.vue";
import useForm from "@/Composables/form";
import DeleteDialog from "@/Components/DeleteDialog.vue";
import DialogCreate from "@/Components/DialogCreate.vue";
import DialogEdit from "@/Components/DialogEdit.vue";

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
