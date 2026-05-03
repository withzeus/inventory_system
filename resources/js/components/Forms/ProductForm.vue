<script setup lang="ts">
const props = defineProps<{
    form: any;
    loading: boolean;
    submit: (close?: () => void) => void;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
}>();

const close = () => {
    emit('close');
};
</script>

<template>
    <form class="space-y-4" @submit.prevent="submit(close)">
        <input
            v-model="form.name"
            placeholder="Name"
            class="w-full border p-2"
        />

        <input
            v-model="form.stock"
            type="number"
            placeholder="Stock"
            class="w-full border p-2"
        />

        <input
            v-model="form.price"
            type="number"
            placeholder="Price"
            class="w-full border p-2"
        />

        <div class="flex justify-end gap-2">
            <button type="button" @click="close">Cancel</button>
            <button
                type="submit"
                class="bg-gray-600 px-4 py-2 text-white"
                :disabled="loading"
            >
                {{ loading ? 'Saving...' : 'Save' }}
            </button>
        </div>
    </form>
</template>
