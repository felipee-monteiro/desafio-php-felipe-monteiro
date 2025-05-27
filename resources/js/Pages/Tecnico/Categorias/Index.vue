<template>
    <CrudLayout
        mainTitle="Categorias de Chamado"
        notFoundMessage="Nenhuma categoria encontrada"
        :data="categorias"
    >
        <template #createButton>
            <CreateDialog
                buttonTitle="Criar Categoria"
                form="create.submit"
                :dialog="{
                    title: 'Criar Categoria',
                    description: 'Crie uma categoria para os chamados',
                }"
            >
                <div class="my-2">
                    <form
                        id="create.submit"
                        @submit.prevent="handleCreate(data)"
                    >
                        <Label for="category_name">Nome</Label>
                        <Input v-model="createData.name" id="category_name" />
                    </form>
                </div>
            </CreateDialog>
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
                            title: 'Editar categoria - ' + data.name,
                            description:
                                'Edite a categoria de acordo com os campos abaixo',
                        }"
                        form="edit.submit"
                    >
                        <div class="my-2">
                            <form
                                id="edit.submit"
                                @submit.prevent="handleEdit(data)"
                            >
                                <Label for="category_name">Nome</Label>
                                <Input
                                    v-model="editData.newName"
                                    id="category_name"
                                />
                            </form>
                        </div>
                    </DialogEdit>

                    <DeleteDialog
                        :handle-delete="handleDelete"
                        :id="data.id"
                        :type="`a categoria ${data.name}`"
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
import { rmStringSpace } from "@/utils";
import { router } from "@inertiajs/vue3";
import useForm, { globalConfig } from "@/Composables/form.js";
import DeleteDialog from "@/Components/DeleteDialog.vue";
import DialogEdit from "./DialogEdit.vue";
import CreateDialog from "@/Components/DialogCreate.vue";

const editData = useForm({
    newName: "",
});

const createData = useForm({
    name: "",
});

function handleCreate() {
    createData.post(`/tecnico/categorias`);
}

function handleEdit(data) {
    if (rmStringSpace(editData.newName) === rmStringSpace(data.name)) {
        return alert("Por favor, escolha um nome diferente");
    }

    editData.put(`/tecnico/categorias/${data.id}`);
}

function handleDelete(id) {
    router.delete(`/tecnico/categorias/${id}`, globalConfig);
}

defineProps({ categorias: { type: Array, required: true } });
</script>
