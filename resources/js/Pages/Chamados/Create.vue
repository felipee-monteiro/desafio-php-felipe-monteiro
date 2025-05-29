<template>
    <AppLayout>
        <div class="max-w-3xl mx-auto p-6 mt-4 bg-white rounded shadow">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                Abrir Novo Chamado
            </h1>

            <form @submit.prevent="submit" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"
                        >Título</label
                    >
                    <input
                        v-model="form.titulo"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.titulo" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"
                        >Descrição</label
                    >
                    <textarea
                        v-model="form.descricao"
                        rows="4"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Categoria</label
                        >
                        <select
                            v-model="form.categoria_chamado_id"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option
                                v-for="categoria_chamado in categoriasChamado"
                                :value="categoria_chamado.id"
                            >
                                {{ categoria_chamado.name }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1"
                            >Prioridade</label
                        >
                        <select
                            v-model="form.prioridade_chamado_id"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option
                                :key="prioridade.id"
                                :value="prioridade.id"
                                v-for="prioridade in prioridades"
                            >
                                {{ prioridade.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"
                        >Anexo (opcional)</label
                    >
                    <input
                        type="file"
                        @change="handleFile"
                        class="w-full border rounded px-3 py-2"
                    />
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow"
                    >
                        Salvar Chamado
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import useForm from "@/Composables/form";

defineProps({
    categoriasChamado: { type: Array, required: true },
    prioridades: { type: Array, required: true },
});

const form = useForm({
    titulo: "",
    descricao: "",
    status_chamados_id: 1,
    categoria_chamado_id: 1,
    prioridade_chamado_id: 2,
    anexo: null,
});

function handleFile(e) {
    form.anexo = e.target.files[0];
}

function submit() {
    form.post("/chamados", {
        forceFormData: true,
    });
}
</script>
