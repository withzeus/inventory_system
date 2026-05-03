import { ref } from "vue";
import { api } from "@/lib/axios";

type ProductForm = {
    name: string;
    stock: number;
    price: number;
};

export function useProductForm(refetch: () => void) {
    const form = ref<ProductForm>({
        name: "",
        stock: 0,
        price: 0,
    });

    const loading = ref(false);
    const isEdit = ref(false);
    const selectedId = ref<number | null>(null);

    const reset = () => {
        form.value = {
            name: "",
            stock: 0,
            price: 0,
        };

        isEdit.value = false;
        selectedId.value = null;
    };

    const fillForm = (product: any) => {
        form.value = {
            name: product.name,
            stock: product.stock,
            price: product.price,
        };

        isEdit.value = true;
        selectedId.value = product.id;
    };

    const submit = async (close?: () => void) => {
        loading.value = true;

        try {
            if (isEdit.value && selectedId.value) {
                await api.put(`/api/products/${selectedId.value}`, form.value);
            } else {
                await api.post("/api/products", form.value);
            }

            refetch();
            reset();
            close?.();
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
