<template>
    <AppLayout>
        <div class="max-w-5xl mx-auto p-6">
            <div
                v-show="!isValidObject(chamado)"
                class="text-gray-500 text-center py-10"
            >
                Chamado não encontrado
            </div>

            <div>
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Chamado #{{ chamado.id }}
                    </h1>
                </div>

                <div class="grid gap-4">
                    <div
                        class="bg-white shadow rounded p-4 border border-gray-100 hover:shadow-md transition"
                    >
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800">
                                    {{ chamado.titulo }}
                                </h2>
                                <p class="text-sm text-gray-500">
                                    Categoria: {{ chamado.categoria.name }} |
                                    Prioridade: {{ chamado.prioridade }} |
                                    Criado em: {{ chamado.created_at }} |
                                    Atualizado em:
                                    {{ chamado.updated_at }}
                                </p>
                                <div class="flex gap-1 text-sm font-medium mt-1">
                                   <div class="flex items-center gap-1">
                                        <span>Status:</span>
                                        <div v-if="isTecnico()">
                                            <select v-model="updateStatus.status_chamados_id" class="p-0 px-2" @change="handleTecnicoUpdateStatus(chamado.id)">
                                                    <!-- <option value>{{ chamado.status.name }}</option> -->
                                                    <StatusChamadosOptions :status-chamado="statusChamado" />
                                                </select>
                                        </div>
                                        <div v-else>
                                            {{ chamado.status.name }}
                                        </div>
                                   </div>
                                </div>
                                <p class="text-sm font-medium mt-1">
                                    Responsável:
                                    <span class="text-gray-900">{{
                                        chamado.responsavel.name
                                    }}</span>
                                </p>
                                <p
                                    class="flex flex-col gap-2 text-sm font-normal mt-5"
                                >
                                    <div>
                                        Descrição:
                                    <span class="text-gray-700">{{
                                        chamado.descricao
                                    }}</span>
                                    </div>
                                   <div>
                                     <span v-show="isValidString(chamado.anexo)">
                                        <a
                                            target="_blank"
                                            :href="`/storage/${chamado.anexo}`"
                                        >
                                            Anexo:
                                            <span
                                                class="text-sm text-blue-600 hover:underline"
                                            >
                                                {{ chamado.anexo }}
                                            </span>
                                        </a>
                                    </span>
                                   </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { isValidObject, isValidString } from "@/utils";
import { usePage } from "@inertiajs/vue3";
import useForm from "@/Composables/form";
import StatusChamadosOptions from "./StatusChamadosOptions.vue";

const page = usePage();
const updateStatus = useForm({
    status_chamados_id: 0
});

const {
    props: { auth },
} = page;

const roleID = auth.user.role_id;
const { statusChamado } = page.props;

function isTecnico() {
    return roleID === 2;
}

function handleTecnicoUpdateStatus(chamadoId) {
    if (isTecnico()) {
        updateStatus.patch(`/tecnico/chamados/${chamadoId}/status`);
    }
}

defineProps({
    chamado: { type: Object, required: true }
});
</script>
