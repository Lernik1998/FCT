<template>
    <button @click="testConnectionGoogle">Test Google Calendar</button>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";

const testConnectionGoogle = () => {
    router.get("/test-google");
};
</script>

<style>
.trainer-calendar {
    width: 100%;
    min-height: 600px;
}

.fc-event {
    cursor: pointer;
    border-radius: 4px;
    padding: 2px 5px;
}

.fc-daygrid-event {
    margin-bottom: 2px;
}

.fc-toolbar-title {
    font-size: 1.25rem;
    font-weight: 600;
}

.fc-button {
    background-color: #f97316 !important;
    border-color: #f97316 !important;
    color: white !important;
    padding: 0.4em 0.65em !important;
    font-size: 0.9em !important;
}

.fc-button:hover {
    background-color: #ea580c !important;
    border-color: #ea580c !important;
}

.fc-button-active {
    background-color: #c2410c !important;
    border-color: #c2410c !important;
}

.fc-today-button {
    background-color: #f97316 !important;
    border-color: #f97316 !important;
}

.fc-today-button:hover {
    background-color: #ea580c !important;
    border-color: #ea580c !important;
}
</style>
