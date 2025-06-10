<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import { PT_BR_LABELS } from "@/i18n";

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Login" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" :value="PT_BR_LABELS['email']" />
                <TextInput
                    data-testid="email"
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError
                    data-testid="email-error"
                    class="mt-2"
                    :message="form.errors.email"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="password" :value="PT_BR_LABELS['Password']" />
                <TextInput
                    data-testid="password"
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError
                    data-testid="password-error"
                    class="mt-2"
                    :message="form.errors.password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox
                        v-model:checked="form.remember"
                        data-testid="rememberMe"
                        name="remember"
                    />
                    <span class="ms-2 text-sm text-gray-600">
                        {{ PT_BR_LABELS["remember_me"] }}
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    {{ PT_BR_LABELS["forgot_password"] }}
                </Link>

                <PrimaryButton
                    class="ms-4"
                    data-testid="loginButton"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ PT_BR_LABELS["login"] }}
                </PrimaryButton>
            </div>

            <div class="mt-4 text-center">
                <Link
                    href="/register"
                    class="text-sm text-blue-600 hover:underline"
                >
                    {{ PT_BR_LABELS["dont_have_account"] }}
                    {{ PT_BR_LABELS["signup"] }}
                </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
