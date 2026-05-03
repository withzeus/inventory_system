import { computed, ComputedRef } from "vue";
import { usePagination } from "./usePagination";
import { api } from "@/lib/axios";
import { useQuery } from "./useQuery";

type ProductParams = { page : number }

export function useProducts(){
    const { currentPage, links, perPage, total } = usePagination();

    const params = computed(() => ({
        page: currentPage.value
    }))

    const fetchProducts = async (params : any) : Promise<Product[]> => {
        const res = await api.get(`/api/products?page=${params.page}`)
        links.value = res.data.links
        currentPage.value = res.data.current_page
        perPage.value = res.data.per_page
        total.value = res.data.total
        return res.data.data
    }

    const query = useQuery<ComputedRef<ProductParams>, Product[]>(fetchProducts, params);

    return {
        ...query,
        links,
        currentPage,
        perPage,
        total
    }
}
