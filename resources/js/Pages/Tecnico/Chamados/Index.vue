<template>
    <div class="max-w-6xl mx-auto p-6">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4"
        >
            <h1 class="text-2xl font-bold text-gray-800">Chamados Técnicos</h1>
            <div class="flex gap-4">
                <select
                    v-model="filters.status"
                    @change="applyFilters"
                    class="border px-3 py-2 rounded"
                >
                    <option value>Todos os Status</option>
                    <option>Aberto</option>
                    <option>Em atendimento</option>
                    <option>Resolvido</option>
                    <option>Fechado</option>
                </select>

                <select
                    v-model="filters.prioridade"
                    @change="applyFilters"
                    class="border px-3 py-2 rounded"
                >
                    <option value>Todas as Prioridades</option>
                    <option>Baixa</option>
                    <option>Média</option>
                    <option>Alta</option>
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
                            Categoria: {{ chamado.categoria }} | Prioridade:
                            {{ chamado.prioridade }}
                        </p>
                        <p class="text-sm font-medium mt-1">
                            Status:
                            <span class="text-blue-600">{{
                                chamado.status
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
</template>

<script setup>
import { router, Link } from "@inertiajs/vue3";
import { reactive, ref } from "vue";

const { chamados } = defineProps({ chamados: Array });
const initialChamados = ref(chamados);

const filters = reactive({
    status: "",
    prioridade: "",
});

function applyFilters() {
    const shouldDoRequest = Object.values(filters).some(
        (v) => typeof v === "string" && v.trim().length
    );

    if (shouldDoRequest) {
        return router.get("/tecnico/chamados", filters, {
            preserveState: true,
        });
    }
}
</script>
