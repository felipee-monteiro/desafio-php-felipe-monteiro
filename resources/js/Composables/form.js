import { isValidObject, isValidString } from "@/utils";
import { useForm as inertiaUseForm, router, usePage } from "@inertiajs/vue3";
import { toast } from "vue-sonner";
export const globalConfig = {
    async: true,
    onSuccess: function () {
        const {
            props: {
                flash
            }
        } = usePage();

        if (isValidString(flash.success)) {
            toast.success(flash.success);
        }
    },
    onError: function (e) {
        if (isValidObject(e)) {
            Object.values(e).forEach(function (i) {
                toast.error(i);
            });
        }
    },
};

export default function useForm(initialData = {}) {
    const data = inertiaUseForm(initialData);

    data.get = function (url, options) {
        return router.get(url, data.data(), {
            ...options,
            ...globalConfig
        });
    }

    data.post = function (url, options) {
        return router.post(url, data.data(), {
            ...options,
            ...globalConfig
        });
    }

    data.put = function (url, options) {
        return router.put(url, data.data(), {
            ...options,
            ...globalConfig
        });
    }

    data.patch = function (url, options) {
        return router.patch(url, data.data(), {
            ...options,
            ...globalConfig
        });
    }

    data.delete = function (url, options) {
        return router.delete(url, {
            ...options,
            ...globalConfig
        });
    }

    return data;
}
