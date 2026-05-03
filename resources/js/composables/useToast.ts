import { ref } from "vue";

export type ToastType = "success" | "error" | "info";

type Toast = {
    id: number;
    message: string;
    type: ToastType;
};

const toasts = ref<Toast[]>([]);
let id = 0;

export function useToast() {
    const show = (message: string, type: ToastType = "info") => {
        const toast = {
            id: ++id,
            message,
            type,
        };

        toasts.value.push(toast);

        setTimeout(() => {
            remove(toast.id);
        }, 3000);
    };

    const remove = (id: number) => {
        toasts.value = toasts.value.filter((t) => t.id !== id);
    };

    return {
        toasts,
        show,
        success: (msg: string) => show(msg, "success"),
        error: (msg: string) => show(msg, "error"),
        info: (msg: string) => show(msg, "info"),
    };
}
