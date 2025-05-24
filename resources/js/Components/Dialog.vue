<template>
    <Dialog>
        <DialogTrigger as-child>
            <slot name="trigger" />
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>
                    {{ title }}
                </DialogTitle>
                <DialogDescription>
                    {{ decription }}
                </DialogDescription>
            </DialogHeader>

            <slot />

            <DialogFooter>
                <slot name="footer" />
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import {
    Dialog,
    DialogTrigger,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogContent,
    DialogTitle,
} from "@/Components/ui/dialog";

defineProps({ title: String, decription: String });
</script>
