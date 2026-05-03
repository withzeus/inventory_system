import { ref } from "vue";

export function usePagination(){
    const currentPage = ref(0)
    const perPage = ref(0)
    const total = ref(0)
    const links = ref([])

    return {
        currentPage,
        perPage,
        total,
        links,
    }
}
