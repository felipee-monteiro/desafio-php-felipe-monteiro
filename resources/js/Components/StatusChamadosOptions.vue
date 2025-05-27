<template>
    <option :key="status.id" :value="status.id" v-for="status in statusChamado">
        {{ status.name }}
    </option>
</template>

<script setup>
defineProps({
    statusChamado: { type: Array, required: true },
});
</script>
