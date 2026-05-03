import { api } from '@/lib/axios';
import { ref, onMounted } from 'vue';

export function useProductsDropdown() {
    const data = ref<any[]>([]);
    const meta = ref<any>(null);
    const loading = ref(false);

    const fetch = async () => {
        loading.value = true;

        try {
            const res = await api.get(`/api/products/select`);
            data.value = res.data;
        } finally {
            loading.value = false;
        }
    };

    // ✅ SSR-safe
    if (import.meta.env.SSR) {
        // do nothing or prefetch differently
    } else {
        onMounted(fetch);
    }

    return { data, meta, loading, fetch };
}
