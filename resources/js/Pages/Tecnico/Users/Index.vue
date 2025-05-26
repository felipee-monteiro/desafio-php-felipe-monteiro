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
                        :title="`Editar Usuário - ${data.name}`"
                        decription="Controle as configurações de acesso deste usuário"
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
                                    @submit.prevent="handleEdit(data.id)"
                                >
                                    <div class="space-y-4">
                                        <FormField name="is_active">
                                            <FormItem
                                                class="flex flex-row items-center justify-between rounded-lg border p-4"
                                            >
                                                <div class="space-y-0.5">
                                                    <FormLabel
                                                        class="text-base"
                                                    >
                                                        Permitir acesso
                                                    </FormLabel>
                                                    <FormDescription>
                                                        Permitir que este
                                                        usuário acesse a
                                                        plataforma
                                                        <br />com sua role atual
                                                    </FormDescription>
                                                </div>
                                                <FormControl>
                                                    <Switch
                                                        v-model="
                                                            editData.is_active
                                                        "
                                                    />
                                                </FormControl>
                                            </FormItem>
                                        </FormField>
                                        <FormField name="role_id">
                                            <FormItem
                                                class="flex flex-col gap-2 items-center justify-between rounded-lg border p-4"
                                            >
                                                <div class="space-y-0.5">
                                                    <FormLabel
                                                        class="text-base"
                                                    >
                                                        Role
                                                    </FormLabel>
                                                    <FormDescription>
                                                        Mecanismo que dá acessos
                                                        especiais à áreas
                                                        exclusivas do sistema,
                                                        correspondente ao papel
                                                        do usuário na vida real.
                                                    </FormDescription>
                                                </div>
                                                <FormControl
                                                    v-model="editData.role_id"
                                                >
                                                    <Select>
                                                        <SelectTrigger>
                                                            <SelectValue
                                                                :placeholder="
                                                                    data.role
                                                                        .name
                                                                "
                                                            />
                                                        </SelectTrigger>
                                                        <SelectContent>
                                                            <SelectGroup>
                                                                <SelectLabel
                                                                    >Roles</SelectLabel
                                                                >

                                                                <div
                                                                    v-for="role of roles"
                                                                    :key="
                                                                        role.id
                                                                    "
                                                                >
                                                                    <SelectItem
                                                                        :value="
                                                                            role.id
                                                                        "
                                                                        selected
                                                                    >
                                                                        {{
                                                                            role.name
                                                                        }}
                                                                    </SelectItem>
                                                                </div>
                                                            </SelectGroup>
                                                        </SelectContent>
                                                    </Select>
                                                </FormControl>
                                            </FormItem>
                                        </FormField>
                                    </div>
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
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select";
import CrudLayout from "@/Layouts/CrudLayout.vue";
import {
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
} from "@/Components/ui/form";
import { Switch } from "@/Components/ui/switch";
import useForm from "@/Composables/form.js";

const editData = useForm({
    role_id: 0,
    is_active: true,
});

function handleEdit(id) {
    editData.put(`/tecnico/users/${id}`);
}

defineProps({
    users: { type: Array, required: true },
    roles: { type: Array, required: true },
});
</script>
