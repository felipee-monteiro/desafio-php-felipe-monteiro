<template>
    <option
        :key="priority.id"
        :value="priority.id"
        v-for="priority in priorities"
    >
        {{ priority.name }}
    </option>
</template>

<script setup>
defineProps({
    priorities: { type: Array, required: true },
});
</script>
