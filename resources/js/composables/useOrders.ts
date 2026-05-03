import { computed, ComputedRef } from "vue";
import { usePagination } from "./usePagination";
import { api } from "@/lib/axios";
import { useQuery } from "./useQuery";

type OrderParams = { page : number }

export function useOrders(){
    const { currentPage, links, perPage, total } = usePagination();

    const params = computed(() => ({
        page: currentPage.value
    }))

    const fetchOrders = async (params : any) : Promise<Order[]> => {
        const res = await api.get(`/api/orders?page=${params.page}`)
        links.value = res.data.links
        currentPage.value = res.data.current_page
        perPage.value = res.data.per_page
        total.value = res.data.total
        return res.data.data
    }

    const query = useQuery<ComputedRef<OrderParams>, Order[]>(fetchOrders, params);

    return {
        ...query,
        links,
        currentPage,
        perPage,
        total
    }
}
