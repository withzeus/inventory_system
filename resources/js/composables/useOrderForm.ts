import { ref } from 'vue';
import { api } from '@/lib/axios';
import { useToast } from './useToast';

type OrderForm = {
    total_price: number;
    items: OrderItem[];
};

type OrderItem = {
    product_id: string;
    quantity: number;
};

export function useOrderForm(refetch: () => void) {
    const toast = useToast();
    const form = ref<OrderForm>({
        total_price: 0,
        items: [],
    });

    const loading = ref(false);
    const isEdit = ref(false);
    const selectedId = ref<number | null>(null);

    const reset = () => {
        form.value = {
            total_price: 0,
            items: [],
        };

        isEdit.value = false;
        selectedId.value = null;
    };

    const fillForm = (order: any) => {
        form.value = {
            total_price: order.total_price,
            items: order.items.map((item: OrderItem) => ({
                product_id: String(item.product_id),
                quantity: Number(item.quantity),
            })),
        };

        isEdit.value = true;
        selectedId.value = order.id;
    };

    const submit = async (close?: () => void) => {
        loading.value = true;

        try {
            if (isEdit.value && selectedId.value) {
                await api.put(`/api/orders/${selectedId.value}`, form.value);
                toast.success('Order updated successfully');
            } else {
                await api.post('/api/orders', form.value);
                toast.success('Order created successfully');
            }
            refetch();
            reset();
            close?.();
        } catch {
            toast.error('Something went wrong');
        } finally {
            loading.value = false;
        }
    };

    return {
        form,
        loading,
        isEdit,
        submit,
        fillForm,
        reset,
    };
}
