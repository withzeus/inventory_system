<script setup lang="ts">
import { useSidebar } from '@/composables/useSidebar';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const dropdownOpen = ref(false);
const { isOpen } = useSidebar();
</script>

<template>
    <header
        class="flex items-center justify-between border-b-4 border-gray-600 bg-white px-6 py-4"
    >
        <div class="flex items-center">
            <button
                class="text-gray-500 focus:outline-none lg:hidden"
                @click="isOpen = true"
            >
                <svg
                    class="h-6 w-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M4 6H20M4 12H20M4 18H11"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>

            <div class="relative mx-4 lg:mx-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg
                        class="h-5 w-5 text-gray-500"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <path
                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>

                <input
                    class="focus:ring-opacity-40 w-32 rounded-md border-gray-200 pr-4 pl-10 text-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500 sm:w-64"
                    type="text"
                    placeholder="Search"
                />
            </div>
        </div>

        <div class="flex items-center">
            <button class="mx-4 flex text-gray-600 focus:outline-none">
                <svg
                    class="h-6 w-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </button>

            <div class="relative">
                <button
                    class="relative z-10 block h-8 w-8 overflow-hidden rounded-full shadow focus:outline-none"
                    @click="dropdownOpen = !dropdownOpen"
                >
                    <img
                        class="h-full w-full object-cover"
                        src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=296&q=80"
                        alt="Your avatar"
                    />
                </button>

                <div
                    v-show="dropdownOpen"
                    class="fixed inset-0 z-10 h-full w-full"
                    @click="dropdownOpen = false"
                />

                <transition
                    enter-active-class="transition duration-150 ease-out transform"
                    enter-from-class="scale-95 opacity-0"
                    enter-to-class="scale-100 opacity-100"
                    leave-active-class="transition duration-150 ease-in transform"
                    leave-from-class="scale-100 opacity-100"
                    leave-to-class="scale-95 opacity-0"
                >
                    <div
                        v-show="dropdownOpen"
                        class="absolute right-0 z-20 mt-2 w-48 rounded-md bg-white py-2 shadow-xl"
                    >
                        <a
                            href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-600 hover:text-white"
                            >Profile</a
                        >
                        <Link
                            href="/logout"
                            method="post"
                            as="a"
                            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-600 hover:text-white"
                        >
                            Log out
                        </Link>
                    </div>
                </transition>
            </div>
        </div>
    </header>
</template>
