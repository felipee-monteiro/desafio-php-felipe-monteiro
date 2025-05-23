<script setup>
import { isValidString } from "@/utils";
import { usePage } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { toast } from "vue-sonner";

const {
    props: { flash },
} = usePage();

onMounted(() => {
    if (isValidString(flash.success)) {
        toast.success(flash.success);
    }
});
</script>
