<template>
    <nav class="p-4 border-b shadow-md bg-white">
        <div class="mx-auto flex justify-between items-center">
            <div class="text-xl font-bold">FitWorking</div>

            <!-- <p>{{ $page.component }}</p> -->

            <div>
                <ul class="flex space-x-6">
                    <li>
                        <Link
                            :href="route('index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Index',
                            }"
                            >Inicio</Link
                        >
                    </li>

                    <li>
                        <Link
                            :href="route('activities.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Activity',
                            }"
                            >Actividades</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('trainers.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Trainer',
                            }"
                            >Entrenadores</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('posts.index')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Posts',
                            }"
                            >Posts</Link
                        >
                    </li>
                    <!--    <li>
                        <a :href="route('eventos')" class="hover:underline"
                            >Eventos</a
                        >
                    </li> -->

                    <!-- <li>
                <a :href="route('contact')" class="hover:underline">Contacto</a>
            </li> -->

                    <li>
                        <Link
                            :href="route('contact')"
                            class="hover:underline"
                            :class="{
                                'font-bold text-orange-500 underline':
                                    $page.component === 'Public/Contact',
                            }"
                            >Contacto</Link
                        >
                    </li>

                    <li>
                        <Link :href="route('login')" class="hover:underline"
                            >Iniciar Sesion</Link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
</script>
