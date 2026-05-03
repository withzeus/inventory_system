<script setup lang="ts">
import { ref } from 'vue';
import DefaultLayout from '@/components/DefaultLayout.vue';
import Modal from '@/components/Modal.vue';
import Pagination from '@/components/Pagination.vue';
import ProductForm from '@/components/Forms/ProductForm.vue';
import { useProducts } from '@/composables/useProducts';
import { useProductForm } from '@/composables/useProductForm';

defineOptions({ layout: DefaultLayout });

const { data, loading, error, currentPage, links, refetch, perPage } =
    useProducts();

const open = ref(false);

const {
    form,
    loading: formLoading,
    isEdit,
    submit,
    fillForm,
    reset,
} = useProductForm(refetch);

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
        <Modal
            v-model:open="open"
            :title="isEdit ? 'Edit product' : 'Add product'"
        >
            <ProductForm
                :form="form"
                :loading="formLoading"
                :submit="submit"
                @close="open = false"
            />
        </Modal>
        <div class="flex items-center justify-between">
            <h3 class="text-3xl font-medium text-gray-700">Products</h3>
            <button
                class="rounded-md bg-gray-600 px-6 py-3 text-white"
                @click="
                    () => {
                        reset();
                        open = true;
                    }
                "
            >
                Add Product
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
                    We couldn’t load the products. Please try again.
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
                                        Name
                                    </th>
                                    <th
                                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs leading-4 font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Stock
                                    </th>
                                    <th
                                        class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs leading-4 font-medium tracking-wider text-gray-500 uppercase"
                                    >
                                        Price
                                    </th>
                                    <th
                                        class="border-b border-gray-200 bg-gray-50 px-6 py-3"
                                    />
                                </tr>
                            </thead>

                            <tbody class="bg-white">
                                <tr
                                    v-for="(product, index) in data || []"
                                    :key="product.id"
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
                                            {{ product.name }}
                                        </div>
                                    </td>

                                    <td
                                        class="border-b border-gray-200 px-6 py-4 whitespace-nowrap"
                                    >
                                        <div
                                            class="text-sm leading-5 text-gray-900"
                                        >
                                            {{ product.stock }}
                                        </div>
                                    </td>

                                    <td
                                        class="border-b border-gray-200 px-6 py-4 whitespace-nowrap"
                                    >
                                        <div
                                            class="text-sm leading-5 text-gray-900"
                                        >
                                            {{ product.price }}
                                        </div>
                                    </td>

                                    <td
                                        class="border-b border-gray-200 px-6 py-4 text-right text-sm leading-5 font-medium whitespace-nowrap"
                                    >
                                        <button
                                            class="text-gray-600 hover:text-gray-900"
                                            @click="openEdit(product)"
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
                No products found.
            </div>

            <Pagination :links="links" @change-page="handlePage" />
        </div>
    </div>
</template>
