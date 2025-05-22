<template>
    <div class="max-w-5xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Meus Chamados</h1>
            <Link
                href="/chamados/create"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow"
            >
                Novo Chamado
            </Link>
        </div>

        <div
            v-if="chamados.length === 0"
            class="text-gray-500 text-center py-10"
        >
            Nenhum chamado encontrado.
        </div>

        <div v-else class="grid gap-4">
            <div
                v-for="chamado in chamados"
                :key="chamado.id"
                class="bg-white shadow rounded p-4 border border-gray-100 hover:shadow-md transition"
            >
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            {{ chamado.titulo }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            Categoria: {{ chamado.categoria.name }} |
                            Prioridade: {{ chamado.prioridade }}
                        </p>
                        <p class="text-sm font-medium mt-1">
                            Status:
                            <span class="text-blue-600">{{
                                chamado.status
                            }}</span>
                        </p>
                    </div>
                    <Link
                        :href="`/chamados/${chamado.id}`"
                        class="text-sm text-blue-600 hover:underline"
                        >Visualizar</Link
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ chamados: Array });
</script>
