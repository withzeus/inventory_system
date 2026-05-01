<script setup lang="ts">
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

const showPassword = ref(false);

const form = useForm({
    email: '',
    password: '',
});

const login = () => {
    form.post('/login');
};
</script>

<template>
    <div
        class="flex h-screen items-center justify-center bg-gray-200 px-6 font-serif"
    >
        <div class="w-full max-w-sm rounded-md bg-white p-6 shadow-md">
            <div class="justify-left flex items-center gap-5">
                <svg
                    fill="#000000"
                    class="h-7 w-7"
                    version="1.2"
                    baseProfile="tiny"
                    id="inventory"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 256 230"
                    xml:space="preserve"
                >
                    <path
                        d="M61.2,106h37.4v31.2H61.2V106z M61.2,178.7h37.4v-31.2H61.2V178.7z M61.2,220.1h37.4v-31.2H61.2V220.1z M109.7,178.7H147
	v-31.2h-37.4V178.7z M109.7,220.1H147v-31.2h-37.4V220.1z M158.2,188.9v31.2h37.4v-31.2H158.2z M255,67.2L128.3,7.6L1.7,67.4
	l7.9,16.5l16.1-7.7v144h18.2V75.6h169v144.8h18.2v-144l16.1,7.5L255,67.2z"
                    />
                </svg>
                <span class="text-xl font-semibold text-gray-700"
                    >Order and Inventory System</span
                >
            </div>

            <form class="mt-4" @submit.prevent="login">
                <div>
                    <label class="text-sm text-gray-700">Email</label>
                    <input
                        v-model="form.email"
                        @input="form.clearErrors('email')"
                        type="email"
                        :class="[
                            'mt-1 w-full rounded-md border px-3 py-2 transition focus:ring',
                            form.errors.email
                                ? 'border-red-500 focus:border-red-500 focus:ring-red-200'
                                : 'border-gray-200 focus:border-indigo-600 focus:ring-indigo-500',
                        ]"
                    />
                    <p
                        v-if="form.errors.email"
                        class="mt-1 text-xs text-red-600"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>

                <div>
                    <label class="text-sm text-gray-700">Password</label>

                    <div class="relative mt-1">
                        <input
                            v-model="form.password"
                            @input="form.clearErrors('password')"
                            :type="showPassword ? 'text' : 'password'"
                            :class="[
                                'w-full rounded-md border px-3 py-2 pr-10 transition focus:ring',
                                form.errors.password
                                    ? 'border-red-500 focus:border-red-500 focus:ring-red-200'
                                    : 'border-gray-200 focus:border-indigo-600 focus:ring-indigo-500',
                            ]"
                        />

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700"
                        >
                            <svg
                                v-if="showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5
               c4.477 0 8.268 2.943 9.542 7
               -1.274 4.057-5.065 7-9.542 7
               -4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>

                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19
               c-4.478 0-8.268-2.943-9.542-7
               a9.956 9.956 0 012.293-3.95"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6.223 6.223A9.956 9.956 0 0112 5
               c4.477 0 8.268 2.943 9.542 7
               a9.956 9.956 0 01-4.132 5.411"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 3l18 18"
                                />
                            </svg>
                        </button>
                    </div>

                    <p
                        v-if="form.errors.password"
                        class="mt-1 text-xs text-red-600"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>

                <div class="mt-4 flex items-center justify-between">
                    <div>
                        <label class="inline-flex items-center">
                            <input
                                type="checkbox"
                                class="focus:ring-opacity-40 rounded-md border-gray-200 text-indigo-600 focus:border-indigo-600 focus:ring focus:ring-indigo-500"
                            />
                            <span class="mx-2 text-sm text-gray-600"
                                >Remember me</span
                            >
                        </label>
                    </div>

                    <div>
                        <a
                            class="fontme block text-sm text-indigo-700 hover:underline"
                            href="#"
                            >Forgot your password?</a
                        >
                    </div>
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="w-full rounded-md bg-gray-600 px-4 py-2 text-center text-sm text-white hover:bg-gray-500 focus:outline-none"
                    >
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
