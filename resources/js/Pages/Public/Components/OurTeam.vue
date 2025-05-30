<template>
    <section class="py-8 px-4 sm:px-6 dark:bg-gray-900">
        <h2
            class="text-center text-2xl md:text-3xl font-semibold mb-8 dark:text-white"
        >
            {{ $t("pages.Team.team_section.title") }}
        </h2>
        <div class="flex flex-wrap justify-center gap-6 max-w-7xl mx-auto">
            <!-- Team Member 1 -->
            <div
                class="w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)]"
            >
                <div
                    class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden h-full transition-transform hover:scale-[1.02] flex flex-col"
                >
                    <div class="w-full h-64 md:h-80 overflow-hidden">
                        <img
                            src="../../../../../public/ownImages/ceo.jpg"
                            alt="Alicia Torres"
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                        />
                    </div>
                    <div class="p-6 text-center flex-grow">
                        <h2 class="text-xl font-bold dark:text-white">
                            {{ $t("pages.Team.team_section.members.0.name") }}
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{
                                $t("pages.Team.team_section.members.0.position")
                            }}
                        </p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">
                            {{
                                $t(
                                    "pages.Team.team_section.members.0.description"
                                )
                            }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div
                class="w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)]"
            >
                <div
                    class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden h-full transition-transform hover:scale-[1.02] flex flex-col"
                >
                    <div class="w-full h-64 md:h-80 overflow-hidden">
                        <img
                            src="../../../../../public/ownImages/nutrition.avif"
                            alt="Elena Fernández"
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                        />
                    </div>
                    <div class="p-6 text-center flex-grow">
                        <h2 class="text-xl font-bold dark:text-white">
                            {{ $t("pages.Team.team_section.members.1.name") }}
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{
                                $t("pages.Team.team_section.members.1.position")
                            }}
                        </p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">
                            {{
                                $t(
                                    "pages.Team.team_section.members.1.description"
                                )
                            }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div
                class="w-full sm:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1.5rem)]"
            >
                <div
                    class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden h-full transition-transform hover:scale-[1.02] flex flex-col"
                >
                    <div class="w-full h-64 md:h-80 overflow-hidden">
                        <img
                            src="../../../../../public/ownImages/trainer.jpg"
                            alt="Carlos Méndez"
                            class="w-full h-full object-cover object-center"
                            loading="lazy"
                        />
                    </div>
                    <div class="p-6 text-center flex-grow">
                        <h2 class="text-xl font-bold dark:text-white">
                            {{ $t("pages.Team.team_section.members.2.name") }}
                        </h2>
                        <p class="text-gray-500 dark:text-gray-400">
                            {{
                                $t("pages.Team.team_section.members.2.position")
                            }}
                        </p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">
                            {{
                                $t(
                                    "pages.Team.team_section.members.2.description"
                                )
                            }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "OutTeam",
};
</script>
