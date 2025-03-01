<template>
    <div>
        <!-- Navegación -->
        <nav class="p-4 border-b shadow-md bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">Marina Alta Sports</div>
                <NavBar />
            </div>
        </nav>

        <!-- Banner Principal -->
        <section class="text-center py-16 bg-gray-100">
            <h1 class="text-4xl font-bold mb-4">
                Discover Sports in Marina Alta
            </h1>
            <p class="text-lg mb-6">
                Find activities, connect with trainers, and join the local
                sports community.
            </p>
            <div class="space-x-4">
                <button class="px-6 py-2 bg-black text-white rounded-lg">
                    Get Started
                </button>
                <button class="px-6 py-2 border border-gray-800 rounded-lg">
                    Browse Activities
                </button>
            </div>
        </section>

        <!-- Popular Activities -->
        <section class="py-12 px-4">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">Popular Activities</h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <ActivityCard
                        title="Running Groups"
                        description="Join local running communities for all levels."
                    />
                    <ActivityCard
                        title="Swimming Classes"
                        description="Professional swimming instruction for all ages."
                    />
                    <ActivityCard
                        title="Cycling Tours"
                        description="Explore Marina Alta on two wheels."
                    />
                </div>
            </div>
        </section>

        <!-- Featured Trainers -->
        <section class="py-12 px-4 bg-gray-100">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">Featured Trainers</h2>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8"
                >
                    <TrainerCard name="Alex Martinez" role="Personal Trainer" />
                    <TrainerCard name="Sara Wilson" role="Yoga Instructor" />
                    <TrainerCard name="Mark Johnson" role="Swimming Coach" />
                    <TrainerCard name="Lisa Chen" role="Fitness Expert" />
                </div>
            </div>
        </section>

        <!-- Featured Businesses -->
        <section class="py-12 px-4">
            <div class="container mx-auto text-center">
                <h2 class="text-3xl font-semibold mb-6">Featured Businesses</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <BusinessCard
                        name="FitZone Gym"
                        description="State-of-the-art equipment and expert training staff."
                    />
                    <BusinessCard
                        name="Marina Sports Club"
                        description="Professional water sport facilities and equipment rental."
                    />
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import NavBar from "./Public/Components/NavBar.vue";
import Footer from "./Public/Components/Footer.vue";
// import ActivityCard from "./Public/Components/ActivityCard.vue";
// import TrainerCard from "./Public/Components/TrainerCard.vue";
// import BusinessCard from "./Public/Components/BusinessCard.vue";
</script>

<style scoped>
button {
    transition: all 0.3s;
}
button:hover {
    opacity: 0.8;
}
</style>
