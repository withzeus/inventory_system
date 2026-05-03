<template>
    <div>
        <div v-if="loading">Loading...</div>

        <table v-else class="w-full border">
            <thead>
                <slot name="head"></slot>
            </thead>

            <tbody>
                <tr v-for="item in data" :key="item.id">
                    <slot name="row" :item="item"></slot>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 flex gap-2">
            <button @click="$emit('prev')" :disabled="page === 1">Prev</button>
            <button @click="$emit('next')">Next</button>
        </div>
    </div>
</template>

<script setup lang="ts">
defineProps({
    data: Array,
    loading: Boolean,
    page: Number,
});
defineEmits(['next', 'prev']);
</script>
