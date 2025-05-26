<template>
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
                                Prioridade: {{ chamado.prioridade }} | Criado
                                em: {{ chamado.created_at }} | Atualizado em:
                                {{ chamado.updated_at }}
                            </p>
                            <p class="text-sm font-medium mt-1">
                                Status:
                                <span class="text-blue-600">{{
                                    chamado.status.name
                                }}</span>
                            </p>
                            <p class="text-sm font-medium mt-1">
                                Responsável:
                                <span class="text-gray-900">{{
                                    chamado.responsavel.name
                                }}</span>
                            </p>
                            <p class="text-sm font-normal mt-5">
                                Descrição:
                                <span class="text-gray-700">{{
                                    chamado.descricao
                                }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { isValidObject } from "@/utils";
import { usePage } from "@inertiajs/vue3";

const {
    props: { auth },
} = usePage();

const roleID = auth.user.role_id;

function isTecnico() {
    return roleID === 2;
}

defineProps({ chamado: { type: Object, required: true } });
</script>
