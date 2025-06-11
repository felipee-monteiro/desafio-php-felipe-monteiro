<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import { PT_BR_LABELS } from "@/i18n";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Head title="Forgot Password" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            {{ PT_BR_LABELS["forgot_pass_long"] }}
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" :value="PT_BR_LABELS['email']" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    data-testid="resetPasswordEmailField"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError
                    data-testid="resetPasswordEmailField-error"
                    class="mt-2"
                    :message="form.errors.email"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    data-testid="resetPasswordButton"
                    :disabled="form.processing"
                >
                    {{ PT_BR_LABELS["email_password_reset_link"] }}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
