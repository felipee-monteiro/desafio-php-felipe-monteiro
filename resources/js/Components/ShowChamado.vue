<script setup>
import ChamadoCard from "@/Components/ChamadoCard.vue";
const { chamado } = defineProps({ chamado: Object });
</script>

<template>
    <ChamadoCard :chamado="chamado" />
</template>
