<script setup lang="ts">
import { ref } from 'vue';
import DefaultLayout from '@/components/DefaultLayout.vue';
import Modal from '@/components/Modal.vue';
import Pagination from '@/components/Pagination.vue';
import { useOrders } from '@/composables/useOrders';
import { useOrderForm } from '@/composables/useOrderForm';
import OrderForm from '@/components/Forms/OrderForm.vue';
import { useProductsDropdown } from '@/composables/useProductsDropdown';

const { data: products, fetch: refetchProducts } = useProductsDropdown();

defineOptions({ layout: DefaultLayout });

const {
    data,
    loading,
    error,
    currentPage,
    links,
    refetch: refetchOrders,
    perPage,
} = useOrders();

const open = ref(false);

const refetch = () => {
    refetchOrders();
    refetchProducts();
};

const {
    form,
    loading: formLoading,
    isEdit,
    submit,
    fillForm,
    reset,
} = useOrderForm(refetch);

const handlePage = (url: string | null) => {
    if (!url) return;

    const page = new URL(url).searchParams.get('page');
    currentPage.value = Number(page);
};

const openEdit = (product: any) => {
    fillForm(product);
    open.value = true;
};
</script>

<template>
    <div>
        <Modal v-model:open="open" :title="isEdit ? 'Edit order' : 'Add order'">
            <OrderForm
                :form="form"
                :products="products"
                :loading="formLoading"
                :submit="submit"
                @close="open = false"
            />
        </Modal>
        <div class="flex items-center justify-between">
            <h3 class="text-3xl font-medium text-gray-700">Orders</h3>
            <button
                class="rounded-md bg-gray-600 px-6 py-3 text-white"
                @click="
                    () => {
                        reset();
                        open = true;
                    }
                "
            >
                Add Order
            </button>
        </div>

        <div
            v-if="loading"
            class="absolute inset-0 flex items-center justify-center bg-white/70"
        >
            <div
                class="h-8 w-8 animate-spin rounded-full border-4 border-blue-600 border-t-transparent"
            ></div>
        </div>

        <div v-else-if="error" class="flex items-center justify-center py-20">
            <div class="max-w-md text-center">
                <div
                    class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100"
                >
                    <svg
                        class="h-6 w-6 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </div>

                <h2 class="text-lg font-semibold text-gray-800">
                    Something went wrong
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    We couldn’t load the orders. Please try again.
                </p>

                <button
                    class="mt-4 rounded-md bg-red-600 px-4 py-2 text-sm text-white hover:bg-red-500"
                    @click="refetch"
                >
                    Try again
                </button>
            </div>
        </div>

        <div v-else>
            <div class="mt-4" />

            <div class="mt-8 flex flex-col">
                <div
                    class="-my-2 overflow-x-auto py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
                >
                    <div
                        class="inline-block min-w-full overflow-hidden border-b border-gray-200 align-middle shadow sm:rounded-lg"
                    >
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th
                                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs leading-4 font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        ID
                                    </th>
                                    <th
                                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs leading-4 font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Ordered By
                                    </th>
                                    <th
                                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs leading-4 font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Total Price
                                    </th>
                                    <th
                                        class="border-b border-gray-200 bg-gray-50 px-6 py-3"
                                    />
                                </tr>
                            </thead>

                            <tbody class="bg-white">
                                <tr
                                    v-for="(order, index) in data || []"
                                    :key="order.id"
                                >
                                    <td
                                        class="border-b border-gray-200 px-6 py-4 whitespace-nowrap"
                                    >
                                        <div
                                            class="text-sm leading-5 text-gray-900"
                                        >
                                            {{
                                                (currentPage - 1) * perPage +
                                                index +
                                                1
                                            }}
                                        </div>
                                    </td>
                                    <td
                                        class="border-b border-gray-200 px-6 py-4 whitespace-nowrap"
                                    >
                                        <div
                                            class="text-sm leading-5 text-gray-900"
                                        >
                                            {{ order.user.name }}
                                        </div>
                                    </td>

                                    <td
                                        class="border-b border-gray-200 px-6 py-4 whitespace-nowrap"
                                    >
                                        <div
                                            class="text-sm leading-5 text-gray-900"
                                        >
                                            {{ order.total_price }}
                                        </div>
                                    </td>

                                    <td
                                        class="border-b border-gray-200 px-6 py-4 text-sm leading-5 font-medium whitespace-nowrap"
                                    >
                                        <button
                                            class="text-gray-600 hover:text-gray-900"
                                            @click="openEdit(order)"
                                        >
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div v-if="!loading && data && data.length === 0" class="mt-4">
                No orders found.
            </div>

            <Pagination :links="links" @change-page="handlePage" />
        </div>
    </div>
</template>
