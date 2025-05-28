<template>
    <CrudLayout
        main-title="Gerenciamento de prioridades dos chamados"
        not-found-message="Prioridades não disponíveis"
        :data="prioridadesChamados"
    >
        <template #createButton>
            <DialogCreate
                button-title="Nova Prioridade"
                form="create.submit"
                :dialog="{
                    title: 'Criar Prioridade',
                    description:
                        'Crie uma prioridade para classificar os chamados',
                }"
            >
                <div class="my-2">
                    <form
                        id="create.submit"
                        @submit.prevent="handleCreate(data)"
                    >
                        <Label for="priority_name">Nome</Label>
                        <Input v-model="createData.name" id="priority_name" />
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
                            title: 'Editar prioridade - ' + data.name,
                            description:
                                'Edite a prioridade de acordo com os campos abaixo',
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
                                    v-model="editData.name"
                                    id="status_edit_name"
                                />
                            </form>
                        </div>
                    </DialogEdit>

                    <DeleteDialog
                        :handleDelete="handleDelete"
                        :type="`a prioridade
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
import useForm, { globalConfig } from "@/Composables/form";
import DeleteDialog from "@/Components/DeleteDialog.vue";
import DialogCreate from "@/Components/DialogCreate.vue";
import DialogEdit from "@/Components/DialogEdit.vue";

import { router } from "@inertiajs/vue3";

const PRIORITY_URL = "/tecnico/chamados/prioridades/manage";

defineProps({ prioridadesChamados: { type: Array, required: true } });

const createData = useForm({
    name: "",
});

const editData = useForm({
    name: "",
});

function handleCreate() {
    createData.post(PRIORITY_URL);
}

function handleEdit(data) {
    editData.patch(`${PRIORITY_URL}/${data.id}`);
}

function handleDelete(id) {
    router.delete(`${PRIORITY_URL}/${id}`, globalConfig);
}
</script>
