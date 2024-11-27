<template>
    <section class="bg-[#F0F5F9] rounded-full flex items-center">
        <h6 :class="[
                day.active ? 'bg-[#181D20] text-white dark:bg-gray-300 dark:text-gray-900':'text-[#181D20]',
                'w-1/2 rounded-full text-center cursor-pointer font-medium'
            ]"
            v-for="day in dates"
            :key="day.id"
            @click="switchActive(day)">{{ day.title }}</h6>
    </section>
</template>
<script setup>
import {ref} from 'vue';

let dates = ref([
    { id: 1, title: 'Сегодня', active: true },
    { id: 2, title: 'Завтра', active: false },
]);
let emits = defineEmits(['day_selected']);
function switchActive(day) {
    dates.value.filter(item => item.active = item.id === day.id);
    emits('day_selected', day);
}
</script>