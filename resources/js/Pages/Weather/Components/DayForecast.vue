<template>
    <section class="space-y-4 divide-y divide-gray-200">
        <WeatherSummary  :data="qwa"/>
		
        <WeatherBlock v-for="set in forecast"
                      :key="set.id"
                      :data="qwe"/>
    </section>
</template>
<script setup>
import WeatherSummary from '@/Pages/Weather/Components/WeatherSummary.vue';
import WeatherBlock from '@/Pages/Weather/Components/WeatherBlock.vue';
import {ref} from 'vue';

let qwa = {
    title: 'Отличный денек гулять!',
    summary:'Погода спокойная, приятная. Идеально для прогулок, активностей на улице или встреч на террасе. Хочешь на природу? Помогу с маршрутом!'
};
let qwe = {
    header: 'Утро',
    temperature: '12-14',
    wind: '13-14',
    summary: 'Оденься потеплее, ночью будет ветерок и небольшая влажность, может выпасть снег.',
};


const props = defineProps({
    data: {
        type: Array,
    }
});

let forecast = ref([
    {id: 1, title: 'Утро', time: '06:00', blocks: [0,1] },
    {id: 2, title: 'День', time: '12:00', blocks: [2,3]},
    {id: 3, title: 'Вечер', time: '18:00', blocks: [4,5]},
    {id: 4, title: 'Ночь', time: '00:00', blocks: [6,7]},
]);
</script>