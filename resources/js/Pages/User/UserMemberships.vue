<template>
    <main>
        <section class="ml-6 mt-10">
            <h1 class="text-2xl font-bold mb-4">Memberships User</h1>
        </section>

        <section class="mt-16">
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-3">
                <div
                    class="border rounded-xl p-4 shadow hover:shadow-lg transition"
                >
                    <h2 class="text-xl font-semibold text-orange-500">
                        Básica
                    </h2>
                    <p class="mt-2 text-gray-700">
                        Acceso limitado a áreas comunes y 5 horas mensuales de
                        coworking.
                    </p>
                </div>

                <div
                    class="border rounded-xl p-4 shadow hover:shadow-lg transition"
                >
                    <h2 class="text-xl font-semibold text-orange-500">Pro</h2>
                    <p class="mt-2 text-gray-700">
                        Acceso completo al coworking, 10 horas mensuales de
                        fitness y Wi-Fi premium.
                    </p>
                </div>

                <div
                    class="border rounded-xl p-4 shadow hover:shadow-lg transition"
                >
                    <h2 class="text-xl font-semibold text-orange-500">Elite</h2>
                    <p class="mt-2 text-gray-700">
                        Acceso 24/7, zona fitness completa, eventos exclusivos y
                        oficina privada.
                    </p>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";

defineOptions({
    layout: UserLayout,
});
</script>
