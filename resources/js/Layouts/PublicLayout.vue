<template>
    <div class="min-h-screen dark:bg-gray-900">
        <!-- Cabecera -->
        <NavBar />

        <!-- Cuerpo -->
        <main>
            <slot />
        </main>

        <!-- Pie -->
        <Footer />
    </div>
</template>

<script setup>
import NavBar from "@/Pages/Public/Components/NavBar.vue";
import Footer from "@/Pages/Public/Components/Footer.vue";

import { onMounted } from "vue";

/* SEO */

// Datos de la organización (globales)
const organizationSchema = {
    "@context": "https://schema.org",
    "@type": "Organization",
    name: "FitWorking",
    url: "https://fitworking.es",
    logo: "https://fitworking.es/images/logoFW.png",
    sameAs: [
        "https://facebook.com/fitworking",
        "https://twitter.com/fitworking",
    ],
};

onMounted(() => {
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.text = JSON.stringify(organizationSchema);
    document.head.appendChild(script);
});
</script>
