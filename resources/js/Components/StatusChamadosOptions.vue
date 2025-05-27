<template>
    <option
        :key="status.id"
        :selected="status.id === defaultSelected"
        :value="status.id"
        v-for="status in statusChamado"
    >
        {{ status.name }}
    </option>
</template>

<script setup>
defineProps({
    statusChamado: { type: Array, required: true },
    defaultSelected: { type: Number, required: false },
});
</script>
