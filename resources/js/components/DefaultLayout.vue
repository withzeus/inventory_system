<script setup lang="ts">
import Sidebar from './Sidebar.vue';
import Header from './Header.vue';
import ToastContainer from './ToastContainer.vue';
</script>

<template>
    <div class="font-roboto flex h-screen bg-gray-200">
        <Sidebar />

        <div class="relative flex flex-1 flex-col overflow-hidden">
            <Header />

            <ToastContainer />

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
