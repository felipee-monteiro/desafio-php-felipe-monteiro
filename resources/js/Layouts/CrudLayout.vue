<script setup>
import "vue-sonner/style.css";
import { Toaster } from "vue-sonner";
import AppLayout from "./AppLayout.vue";

defineProps({
    mainTitle: String,
    notFoundMessage: String,
    data: Array,
});
</script>

<template>
    <AppLayout v-bind:title="mainTitle">
        <div class="max-w-5xl mx-auto p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ mainTitle }}
                </h1>
                <slot name="createButton" />
            </div>

            <div
                v-if="data.length === 0"
                class="text-gray-500 text-center py-10"
            >
                {{ notFoundMessage }}
            </div>

            <div v-else class="grid gap-4">
                <div
                    v-for="peace in data"
                    :key="peace.id"
                    class="bg-white shadow rounded p-4 border border-gray-100 hover:shadow-md transition"
                >
                    <slot :data="peace" />
                </div>
            </div>

            <Toaster position="top-right" :expand="true" rich-colors />
        </div>
    </AppLayout>
</template>
