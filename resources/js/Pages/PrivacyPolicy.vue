<template>
    <Head title="Privacy Policy" />

    <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
        <div class="pt-4 bg-gray-100 dark:bg-gray-900">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div
                    class="text-2xl font-bold text-center"
                    @click="router.visit(route('register'))"
                >
                    FitWorking
                </div>

                <div
                    class="w-full sm:max-w-2xl mt-6 p-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg prose dark:prose-invert"
                    v-html="policy"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
    policy: String,
});
</script>
