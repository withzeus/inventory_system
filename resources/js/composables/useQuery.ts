import { ref, unref, watch } from "vue";

export function useQuery<P extends object, Response>(
  fetcher: (params?: P) => Promise<Response>,
  params: P
) {
  const data = ref<Response | null>(null);
  const loading = ref(false);
  const error = ref<any>(null);

  const execute = async () => {
    loading.value = true;
    error.value = null;

    try {
      data.value = await fetcher(unref(params));
    } catch (e) {
      error.value = e;
    } finally {
      loading.value = false;
    }
  };

  watch(params, execute, { deep: true, immediate: true });

  return {
    data,
    loading,
    error,
    refetch: execute,
  };
}
