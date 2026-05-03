<script setup lang="ts">
import { useToast } from '@/composables/useToast';

const { toasts } = useToast();

const icons = {
    success: '✓',
    error: '✕',
    info: 'i',
};
</script>

<template>
    <div class="fixed top-6 right-6 z-[9999] flex flex-col gap-3">
        <TransitionGroup name="toast">
            <div
                v-for="t in toasts"
                :key="t.id"
                class="flex min-w-[280px] items-center gap-3 rounded-xl border bg-white/90 p-4 shadow-lg backdrop-blur-md"
                :class="{
                    'border-green-200': t.type === 'success',
                    'border-red-200': t.type === 'error',
                    'border-blue-200': t.type === 'info',
                }"
            >
                <!-- ICON -->
                <div
                    class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-bold"
                    :class="{
                        'bg-green-100 text-green-600': t.type === 'success',
                        'bg-red-100 text-red-600': t.type === 'error',
                        'bg-blue-100 text-blue-600': t.type === 'info',
                    }"
                >
                    {{ icons[t.type] }}
                </div>

                <!-- MESSAGE -->
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">
                        {{ t.message }}
                    </p>
                </div>
            </div>
        </TransitionGroup>
    </div>
</template>

<style>
.toast-enter-active,
.toast-leave-active {
    transition: all 0.25s ease;
}

.toast-enter-from {
    opacity: 0;
    transform: translateY(-10px) scale(0.95);
}

.toast-leave-to {
    opacity: 0;
    transform: translateX(20px) scale(0.95);
}
</style>
