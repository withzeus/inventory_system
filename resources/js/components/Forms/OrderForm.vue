<script setup lang="ts">
import { computed, toRef } from 'vue';

type Product = {
    id: number;
    name: string;
    stock: number;
    price?: number;
};

type OrderItem = {
    product_id: string;
    quantity: number;
};

const props = defineProps<{
    form: {
        total_price: number;
        items: OrderItem[];
    };
    products: Product[];
    loading: boolean;
    submit: (close?: () => void) => void;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
}>();

const form = toRef(props, 'form');

const getProduct = (id: string) =>
    props.products.find((p) => String(p.id) === String(id));

const getStock = (id: string) => getProduct(id)?.stock ?? 0;

const getPrice = (id: string) => getProduct(id)?.price ?? 0;

const isAlreadySelected = (productId: string, currentIndex: number) => {
    return form.value.items.some(
        (item, index) =>
            index !== currentIndex && item.product_id === productId,
    );
};

const addItem = () => {
    form.value.items.push({
        product_id: '',
        quantity: 1,
    });
};

const removeItem = (index: number) => {
    form.value.items.splice(index, 1);
};

const clampQuantity = (item: OrderItem) => {
    const stock = getStock(item.product_id);

    if (item.quantity > stock) {
        item.quantity = stock;
    }

    if (item.quantity < 1) {
        item.quantity = 1;
    }
};

const totalPrice = computed(() => {
    return form.value.items.reduce((sum, item) => {
        const price = getPrice(item.product_id);
        return sum + price * item.quantity;
    }, 0);
});

const handleSubmit = async () => {
    form.value.total_price = totalPrice.value;
    props.submit(() => emit('close'));
};
</script>

<template>
    <form class="flex max-h-[80vh] flex-col" @submit.prevent="handleSubmit">
        <!-- SCROLLABLE BODY -->
        <div class="flex-1 space-y-4 overflow-y-auto pr-1">
            <!-- ITEMS -->
            <div
                v-for="(item, index) in form.items"
                :key="index"
                class="grid grid-cols-12 gap-2 rounded-lg border bg-gray-50 p-3"
            >
                <div class="col-span-7 flex min-w-0 items-start gap-2">
                    <select
                        v-model="item.product_id"
                        class="w-full min-w-0 flex-1 rounded-md border bg-white px-2 py-1 text-sm focus:ring-2 focus:ring-gray-500"
                    >
                        <option value="">Product</option>
                        <option
                            v-for="p in props.products"
                            :key="p.id"
                            :value="p.id"
                            :disabled="isAlreadySelected(String(p.id), index)"
                        >
                            {{ p.name }}
                        </option>
                    </select>

                    <!-- STOCK BADGE -->
                    <div
                        class="flex h-8 shrink-0 items-center text-xs whitespace-nowrap text-gray-500"
                    >
                        <span v-if="item.product_id">
                            {{ getStock(item.product_id) }} pcs
                        </span>
                    </div>
                </div>

                <!-- QTY -->
                <div class="col-span-2">
                    <input
                        v-model.number="item.quantity"
                        type="number"
                        :min="1"
                        class="w-full rounded-md border px-2 py-1 text-sm focus:ring-2 focus:ring-gray-500"
                        @input="clampQuantity(item)"
                    />
                </div>

                <div class="col-span-2 flex items-center text-sm">
                    <span class="font-medium text-gray-800">
                        ${{ getPrice(item.product_id) * item.quantity }}
                    </span>
                </div>

                <div class="col-span-1 flex items-center justify-end">
                    <button
                        type="button"
                        class="text-red-500 hover:text-red-700"
                        @click="removeItem(index)"
                    >
                        ✕
                    </button>
                </div>
            </div>

            <button
                type="button"
                class="w-full rounded-md border border-dashed py-2 text-sm text-gray-600 hover:bg-gray-50"
                @click="addItem"
            >
                + Add Product
            </button>
        </div>

        <!-- STICKY FOOTER -->
        <div class="sticky bottom-0 mt-4 space-y-3 border-t bg-white pt-4">
            <!-- TOTAL -->
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500">Total</span>
                <span class="text-xl font-semibold text-gray-900">
                    ${{ totalPrice }}
                </span>
            </div>

            <!-- ACTIONS -->
            <div class="flex justify-end gap-2">
                <button
                    type="button"
                    class="rounded-md border px-4 py-2 text-sm"
                    @click="emit('close')"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="rounded-md bg-gray-600 px-4 py-2 text-sm text-white hover:bg-gray-500"
                    :disabled="loading"
                >
                    {{ loading ? 'Saving...' : 'Save Order' }}
                </button>
            </div>
        </div>
    </form>
</template>
