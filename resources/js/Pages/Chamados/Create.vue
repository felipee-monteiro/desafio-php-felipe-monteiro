<template>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
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
                <InputError class="mt-2" :message="form.errors.descricao" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"
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
                    <InputError
                        class="mt-2"
                        :message="form.errors.categoria_chamado_id"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1"
                        >Prioridade</label
                    >
                    <select
                        v-model="form.prioridade"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option>Baixa</option>
                        <option>Média</option>
                        <option>Alta</option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.prioridade"
                    />
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
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({ categoriasChamado: Array });

const form = useForm({
    titulo: "",
    descricao: "",
    status_chamados_id: 1,
    categoria_chamado_id: 1,
    prioridade: "Média",
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
