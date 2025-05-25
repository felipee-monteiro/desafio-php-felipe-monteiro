<template>
    <CrudLayout
        mainTitle="Usuários"
        notFoundMessage="Nenhum usuário encontrado"
        :data="users"
    >
        <template #default="{ data }">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ data.name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Criado em: {{ data.created_at }} | Atualizado em:
                        {{ data.updated_at }} | Role: {{ data.role.name }}
                    </p>
                </div>
                <div class="flex gap-2">
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
import useForm from "@/Composables/form.js";

const editData = useForm({
    newName: "",
});

const createData = useForm({
    name: "",
});

function handleEdit(data) {
    if (rmStringSpace(editData.newName) === rmStringSpace(data.name)) {
        return alert("Por favor, escolha um nome diferente");
    }

    editData.put(`/tecnico/users/${data.id}`);
}

defineProps({ users: { type: Array, required: true } });
</script>
