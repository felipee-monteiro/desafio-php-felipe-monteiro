<template>
    <CrudLayout
        mainTitle="Categorias de Chamado"
        notFoundMessage="Nenhuma categoria encontrada"
        :data="categorias"
    >
        <template #createButton>
            <Dialog
                title="Criar Categoria"
                decription="Crie uma categoria para os chamados"
            >
                <template #trigger>
                    <button
                        type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
                    >
                        Nova Categoria
                    </button>
                </template>
                <template #default>
                    <div class="my-2">
                        <form
                            id="create.submit"
                            @submit.prevent="handleCreate(data)"
                        >
                            <Label for="category_name">Nome</Label>
                            <Input
                                v-model="createData.name"
                                id="category_name"
                            />
                        </form>
                    </div>
                </template>
                <template #footer>
                    <button
                        type="submit"
                        form="create.submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
                    >
                        Criar
                    </button>
                </template>
            </Dialog>
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
                    <!-- Edit dialog -->
                    <Dialog
                        :title="`Editar Categoria - ${data.name}`"
                        decription="Edite a categoria dos chamados"
                    >
                        <template #trigger>
                            <button
                                class="text-sm text-blue-600 hover:underline"
                            >
                                Editar
                            </button>
                        </template>
                        <template #default>
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
                        </template>
                        <template #footer>
                            <button
                                type="submit"
                                form="edit.submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
                            >
                                Salvar
                            </button>
                        </template>
                    </Dialog>

                    <!-- Delete dialog -->
                    <Dialog
                        title="Excluir Categoria ?"
                        decription="Todos os chamados com esta categoria serão igualmente excluídos."
                    >
                        <template #trigger>
                            <button
                                type="button"
                                class="text-sm text-red-600 hover:underline"
                            >
                                Excluir
                            </button>
                        </template>

                        <template #footer>
                            <DialogClose as-child>
                                <button
                                    type="button"
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow"
                                >
                                    Cancelar
                                </button>
                            </DialogClose>
                            <button
                                type="submit"
                                form="edit.submit"
                                @click="handleDelete(data.id)"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow"
                            >
                                Sim, Excluir
                            </button>
                        </template>
                    </Dialog>
                </div>
            </div>
        </template>
    </CrudLayout>
</template>

<script setup>
import Dialog from "@/Components/Dialog.vue";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import CrudLayout from "@/Layouts/CrudLayout.vue";
import { rmStringSpace } from "@/utils";
import { router } from "@inertiajs/vue3";
import useForm, { globalConfig } from "@/Composables/form.js";
import { DialogClose } from "@/Components/ui/dialog";

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
