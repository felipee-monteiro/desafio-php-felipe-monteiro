<template>
    <option
        :key="status.id"
        :value="status.id"
        v-for="status of statusChamados"
    >
        {{ status.name }}
    </option>
</template>

<script setup>
defineProps({ statusChamados: { type: Array, required: true } });
</script>
