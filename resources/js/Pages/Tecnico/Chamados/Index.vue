<template>
    <AppLayout>
        <div class="max-w-6xl mx-auto p-6">
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4"
            >
                <h1 class="text-2xl font-bold text-gray-800">
                    Chamados Técnicos
                </h1>
                <div class="flex gap-4">
                    <select
                        v-model="filters.status"
                        @change="applyFilters"
                        class="border px-3 py-2 rounded"
                    >
                        <option value>Todos os Status</option>
                        <StatusChamadosOptions :status-chamado="status" />
                    </select>

                    <select
                        v-model="filters.prioridade"
                        @change="applyFilters"
                        class="border px-3 py-2 rounded"
                    >
                        <option value>Todas as Prioridades</option>
                        <StatusPriorities :priorities="prioridades" />
                    </select>
                </div>
            </div>

            <div
                v-if="chamados.length === 0"
                class="text-center text-gray-500 py-10"
            >
                Nenhum chamado encontrado com os filtros aplicados.
            </div>

            <div v-else class="space-y-4">
                <div
                    v-for="chamado in chamados"
                    :key="chamado.id"
                    class="bg-white border border-gray-100 p-4 rounded shadow hover:shadow-md transition"
                >
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">
                                {{ chamado.titulo }}
                            </h2>
                            <p class="text-sm text-gray-500 mt-1">
                                Categoria: {{ chamado.categoria.name }} |
                                Prioridade:
                                {{ chamado.prioridade.name }}
                            </p>
                            <p class="text-sm font-medium mt-1">
                                Status:
                                <span class="text-blue-600">{{
                                    chamado.status.name
                                }}</span>
                            </p>
                        </div>
                        <Link
                            :href="`/tecnico/chamados/${chamado.id}`"
                            class="text-sm text-blue-600 hover:underline"
                            >Ver Detalhes</Link
                        >
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import StatusChamadosOptions from "@/Components/StatusChamadosOptions.vue";
import StatusPriorities from "@/Components/StatusPriorities.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { router, Link } from "@inertiajs/vue3";
import { reactive } from "vue";

defineProps({ chamados: Array, status: Array, prioridades: Array });

const filters = reactive({
    status: "",
    prioridade: "",
});

function applyFilters() {
    router.get("/tecnico/chamados", filters, {
        preserveState: true,
    });
}
</script>
