<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useSidebar } from '@/composables/useSidebar';

const { isOpen } = useSidebar();

const activeClass = ref(
    'bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100',
);
const inactiveClass = ref(
    'border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100',
);
</script>

<template>
    <div class="flex">
        <!-- Backdrop -->
        <div
            :class="isOpen ? 'block' : 'hidden'"
            class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"
            @click="isOpen = false"
        />
        <!-- End Backdrop -->

        <div
            :class="
                isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'
            "
            class="fixed inset-y-0 left-0 z-30 w-64 transform overflow-y-auto bg-gray-900 transition duration-300 lg:static lg:inset-0 lg:translate-x-0"
        >
            <div class="mt-8 flex items-center px-6">
                <div class="flex items-center gap-4">
                    <svg
                        fill="#fff"
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

                    <span class="text-2xl font-semibold text-white"
                        >Inventory</span
                    >
                </div>
            </div>

            <nav class="mt-10">
                <Link
                    href="/"
                    class="mt-4 flex items-center border-l-4 px-6 py-2 duration-200"
                    :class="[$page.url === '/' ? activeClass : inactiveClass]"
                >
                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z"
                            fill="currentColor"
                        />
                        <path
                            d="M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z"
                            fill="currentColor"
                        />
                    </svg>

                    <span class="mx-4">Dashboard</span>
                </Link>

                <Link
                    href="/orders"
                    class="mt-4 flex items-center border-l-4 px-6 py-2 duration-200"
                    :class="[
                        $page.url === '/orders' ? activeClass : inactiveClass,
                    ]"
                >
                    <svg
                        class="h-5 w-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                        />
                        <path
                            fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                            clip-rule="evenodd"
                        />
                    </svg>

                    <span class="mx-4">Orders</span>
                </Link>

                <Link
                    href="/products"
                    class="mt-4 flex items-center border-l-4 px-6 py-2 duration-200"
                    :class="[
                        $page.url === '/products' ? activeClass : inactiveClass,
                    ]"
                >
                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M5 3C3.89543 3 3 3.89543 3 5V7C3 8.10457 3.89543 9 5 9H7C8.10457 9 9 8.10457 9 7V5C9 3.89543 8.10457 3 7 3H5Z"
                            fill="currentColor"
                        />
                        <path
                            d="M5 11C3.89543 11 3 11.8954 3 13V15C3 16.1046 3.89543 17 5 17H7C8.10457 17 9 16.1046 9 15V13C9 11.8954 8.10457 11 7 11H5Z"
                            fill="currentColor"
                        />
                        <path
                            d="M11 5C11 3.89543 11.8954 3 13 3H15C16.1046 3 17 3.89543 17 5V7C17 8.10457 16.1046 9 15 9H13C11.8954 9 11 8.10457 11 7V5Z"
                            fill="currentColor"
                        />
                        <path
                            d="M11 13C11 11.8954 11.8954 11 13 11H15C16.1046 11 17 11.8954 17 13V15C17 16.1046 16.1046 17 15 17H13C11.8954 17 11 16.1046 11 15V13Z"
                            fill="currentColor"
                        />
                    </svg>

                    <span class="mx-4">Products</span>
                </Link>
            </nav>
        </div>
    </div>
</template>
