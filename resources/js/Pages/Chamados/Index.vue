<template>
    <CrudLayout
        mainTitle="Meus Chamados"
        notFoundMessage="Nenhum chamado encontrado"
        :data="chamados"
    >
        <template #createButton>
            <div class="w-full md:w-auto mt-4 flex flex-col md:flex-row gap-4">
                <select
                    v-model="exportData.format"
                    @change="exportChamadosAsFile"
                    class="border py-2 rounded"
                >
                    <option value>Exportar como</option>
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                    <option value="csv">CSV</option>
                </select>
                <select
                    v-model="filters.status"
                    @change="applyFilters"
                    class="border py-2 rounded"
                >
                    <option value>Todos os Status</option>
                    <StatusChamadosOptions :status-chamado="status" />
                </select>

                <select
                    v-model="filters.prioridade"
                    @change="applyFilters"
                    class="border py-2 rounded"
                >
                    <option value>Todas as Prioridades</option>
                    <StatusPriorities :priorities="prioridades" />
                </select>
                <Link
                    href="/chamados/create"
                    data-testid="createNewChamado"
                    class="bg-blue-600 text-center hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
                >
                    Novo Chamado
                </Link>
            </div>
        </template>
        <template #default="{ data }">
            <div
                class="flex justify-between items-center"
                :data-testid="data.titulo"
            >
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ data.titulo }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Categoria: {{ data.categoria.name }} | Prioridade:
                        {{ data.prioridade.name }}
                    </p>
                    <p class="text-sm font-medium mt-1">
                        Status:
                        <span class="text-blue-600">{{
                            data.status.name
                        }}</span>
                    </p>
                </div>
                <Link
                    :href="`/chamados/${data.id}`"
                    :data-testid="`${data.titulo}-chamadoDetails`"
                    class="text-sm text-blue-600 hover:underline"
                    >Visualizar</Link
                >
            </div>
        </template>
    </CrudLayout>
</template>

<script setup>
import StatusChamadosOptions from "@/Components/StatusChamadosOptions.vue";
import StatusPriorities from "@/Components/StatusPriorities.vue";
import CrudLayout from "@/Layouts/CrudLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { reactive } from "vue";
import useForm from "@/Composables/form";
import { isValidString } from "@/utils";

const { chamados } = defineProps({
    chamados: Array,
    status: Array,
    prioridades: Array,
});

const exportData = useForm({
    format: "",
});

const filters = reactive({
    status: "",
    prioridade: "",
});

function applyFilters() {
    router.get("/chamados", filters, {
        preserveState: true,
    });
}

function exportChamadosAsFile() {
    if (isValidString(exportData.format)) {
        router.post(
            "/colaborador/chamados/export",
            {
                format: exportData.format,
                data: chamados,
            },
            {
                onSuccess: function () {
                    window.history.back();
                },
            },
        );
    }
}
</script>
