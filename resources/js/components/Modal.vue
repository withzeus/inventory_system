<script setup lang="ts">
defineProps<{
    title: string;
}>();

const open = defineModel<boolean>('open');

const close = () => {
    open.value = false;
};
</script>

<template>
    <div>
        <!-- optional trigger button -->
        <button v-if="$slots.trigger" @click="open = true">
            <slot name="trigger" />
        </button>

        <div
            v-if="open"
            class="fixed inset-0 z-50 flex items-center justify-center"
        >
            <div
                class="absolute inset-0 bg-gray-900 opacity-50"
                @click="close"
            />

            <div class="relative z-50 w-11/12 max-w-md rounded bg-white shadow">
                <div class="flex justify-between border-b p-4">
                    <h2 class="text-lg font-bold">{{ title }}</h2>
                    <button @click="close">✕</button>
                </div>

                <div class="p-4">
                    <slot :close="close" />
                </div>
            </div>
        </div>
    </div>
</template>
