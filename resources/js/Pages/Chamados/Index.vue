<template>
    <CrudLayout
        mainTitle="Meus Chamados"
        notFoundMessage="Nenhum chamado encontrado"
        :data="chamados"
    >
        <template #createButton>
            <Link
                href="/chamados/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
            >
                Novo Chamado
            </Link>
        </template>
        <template #default="{ data }">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ data.titulo }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        Categoria: {{ data.categoria.name }} | Prioridade:
                        {{ data.prioridade }}
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
                    class="text-sm text-blue-600 hover:underline"
                    >Visualizar</Link
                >
            </div>
        </template>
    </CrudLayout>
</template>

<script setup>
import CrudLayout from "@/Layouts/CrudLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({ chamados: Array });
</script>
