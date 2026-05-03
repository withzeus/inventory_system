<script setup lang="ts">
import type { PropType } from 'vue';

type PaginationLinks = {
    url: string | null;
    label: string;
    active: boolean;
};

const props = defineProps({
    links: {
        type: Array as PropType<PaginationLinks[]>,
        required: true,
    },
});

const emit = defineEmits<{
    (e: 'change-page', url: string | null): void;
}>();

const handlePage = (url: string | null) => {
    emit('change-page', url);
};
</script>

<template>
    <div class="mt-4 flex flex-wrap items-center space-x-1">
        <button
            v-for="(link, index) in links"
            :key="index"
            v-html="link.label"
            @click="handlePage(link.url)"
            class="rounded border px-3 py-1 text-sm"
            :class="[
                link.active
                    ? 'bg-blue-600 text-white'
                    : 'bg-white text-gray-700',
                !link.url
                    ? 'pointer-events-none opacity-50'
                    : 'hover:bg-gray-100',
            ]"
        />
    </div>
</template>
