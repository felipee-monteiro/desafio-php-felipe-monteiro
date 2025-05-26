<script setup>
import ChamadoCard from "@/Components/ChamadoCard.vue";
defineProps({ chamado: Object });
</script>

<template>
    <ChamadoCard :chamado="chamado" />
</template>
