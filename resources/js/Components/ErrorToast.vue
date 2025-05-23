<script setup>
import { isValidObject } from "@/utils";
import { usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { toast } from "vue-sonner";

const {
    props: { errors },
} = usePage();

onMounted(() => {
    if (isValidObject(errors)) {
        Object.values(errors).forEach(function (error) {
            toast.error(error);
        });
    }
});
</script>
<template></template>
